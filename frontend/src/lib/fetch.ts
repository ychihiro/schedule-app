import { redirect } from "next/navigation";

import { API_BASE_URL, FE_API_BASE_URL, FRONTEND_URL } from "@/constants/env";

const isServerSide = typeof window === "undefined";

export type HttpDocument<
  PathParams = Record<string, string>,
  QueryParams = Record<string, unknown>,
  RequestBody = Record<string, unknown>,
  Response = unknown
> = {
  params: {
    pathParams?: PathParams;
    queryParams?: QueryParams;
    requestBody?: RequestBody;
  };
  response: Response;
  options?: {
    callbacks?: {
      onError?: (error: Error) => void;
      onAuthError?: () => void;
    };
  };
};

export type HttpResponseDocument = Record<string, unknown>;

export async function http<T extends HttpDocument>(
  path: string,
  method: string = "GET",
  params?: T["params"],
  options?: T["options"]
): Promise<T["response"]> {
  const { pathParams, queryParams, requestBody } = params ?? {};
  const { onError, onAuthError } = options?.callbacks ?? {};

  const headers: RequestInit["headers"] = {
    Accept: "application/json",
    "Content-Type": "application/json",
  };

  if (isServerSide) {
    const nextHeaders = await import("next/headers");
    const nextHeadersInstance = await nextHeaders.headers();
    headers["origin"] = FRONTEND_URL || "";
    headers["cookie"] = nextHeadersInstance.get("cookie") ?? "";
  }

  if (["POST", "PUT", "PATCH", "DELETE"].includes(method)) {
    await fetchCsrfToken();

    if (isServerSide) {
      const nextHeaders = await import("next/headers");
      const cookies = await nextHeaders.cookies();
      headers["X-XSRF-TOKEN"] = cookies.get("XSRF-TOKEN")?.value ?? "";
    } else {
      headers["X-XSRF-TOKEN"] = decodeURIComponent(
        decodeURIComponent(
          document.cookie
            .split("; ")
            .find((row) => row.startsWith("XSRF-TOKEN="))
            ?.split("=")[1] || ""
        )
      );
    }
  }

  const endpoint = makeRequestUrl(path, pathParams ?? {}, queryParams ?? {});
  const response = await fetch(endpoint, {
    method: method,
    headers,
    body: requestBody ? JSON.stringify(requestBody) : undefined,
    credentials: "include",
  });

  if (!response.ok) {
    const errorBody = await response.text();

    if (response.status === 401) {
      if (onAuthError) {
        onAuthError();
      } else {
        if (isServerSide) {
          redirect("/login");
        } else {
          location.href = "/login";
        }
      }
    } else {
      // 5xx系のエラーが発生 or 応答がなかった or リクエスト送信前にエラーが発生した場合
      if (isServerSide) {
        throw new Error("API Error: " + errorBody);
      } else {
        const error = new Error("API Error " + errorBody);
        if (onError !== undefined) {
          onError(error);
        } else {
          handleError();
          throw error;
        }
      }
    }
  } else {
    // MEMO: responseが存在しない場合, .jsonでエラーが発生するため, try-catchで処理
    try {
      return await response.json();
    } catch (error) {
      console.log("Invalid JSON response", error);
      return { data: null } as T["response"];
    }
  }

  return { data: null } as T["response"];
}

/**
 * CSRFトークンを取得する
 */
async function fetchCsrfToken() {
  await fetch(`${API_BASE_URL}/sanctum/csrf-cookie`, {
    method: "GET",
    credentials: "include",
    cache: "no-store",
  });
}

/**
 * API実行パスのプレースホルダを実際の値に置換して返却する
 *
 * @template T - HttpDocumentの型
 * @param path - API実行パス
 * @param pathParams - パスパラメータのオブジェクト
 * @param queryParams - クエリパラメータのオブジェクト
 * @returns パラメータ置換後のAPI実行パスの文字列
 */
function makeRequestUrl(
  path: string,
  pathParams: Record<string, string>,
  queryParams: Record<string, unknown>
) {
  const baseUrl = isServerSide
    ? API_BASE_URL || FE_API_BASE_URL
    : FE_API_BASE_URL;

  let endpoint = `${baseUrl}${path}`;

  // パスパラメータが存在する場合, パスパラメータを置換
  if (Object.keys(pathParams ?? {}).length > 0) {
    endpoint = `${baseUrl}${replacePathParams(path, pathParams)}`;
  }

  const query = getQueryString(queryParams);
  return `${endpoint}${query}`;
}

/**
 * API実行パスのプレースホルダを実際の値に置換して返却する
 *
 * @template PathParams - パスパラメータの型
 * @param path - API実行パス
 * @param pathParams - パスパラメータのオブジェクト
 * @returns パラメータ置換後のAPI実行パスの文字列
 */
const replacePathParams = <PathParams extends Record<string, string>>(
  path: string,
  pathParams: PathParams
) => {
  return path.replace(/:([a-zA-Z0-9_]+)/g, (_, key) => {
    const value = pathParams[key];
    if (value === undefined) {
      throw new Error(`Missing required path parameter: ${key}`);
    }

    return encodeURIComponent(value);
  });
};

/**
 * エラーを処理する
 */
async function handleError() {
  const { addToast } = await import("@heroui/react");
  addToast({
    title: "エラーが発生しました",
    description: "エラーが発生しました",
    color: "danger",
  });
}

/**
 * クエリパラメータを文字列に変換する
 *
 * @param queryParams - クエリパラメータのオブジェクト
 * @returns クエリパラメータの文字列
 */
function getQueryString(queryParams: Record<string, unknown>): string {
  const params = Object.entries(queryParams || {}).reduce(
    (acc, [key, value]) => {
      if (value !== undefined) {
        acc[key] = String(value);
      }
      return acc;
    },
    {} as Record<string, string>
  );

  return params ? `?${new URLSearchParams(params).toString()}` : "";
}
