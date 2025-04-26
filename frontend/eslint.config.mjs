import { dirname } from "path";
import { fileURLToPath } from "url";

import { FlatCompat } from "@eslint/eslintrc";

const __filename = fileURLToPath(import.meta.url);
const __dirname = dirname(__filename);

const compat = new FlatCompat({
  baseDirectory: __dirname,
});

const eslintConfig = [
  ...compat.extends("next/core-web-vitals", "next/typescript"),
  {
    rules: {
      "import/order": [
        "error",
        {
          groups: [
            "builtin", // Node.js組み込みモジュール
            "external", // npm パッケージ
            "internal", // エイリアスパス (@/で始まるもの)
            "parent", // 親ディレクトリからのインポート
            "sibling", // 同じディレクトリからのインポート
            "index", // 現在のディレクトリのインデックス
            "object", // オブジェクトインポート
            "type", // 型インポート
          ],
          pathGroups: [
            {
              pattern: "@/**",
              group: "internal",
            },
          ],
          alphabetize: {
            order: "asc", // 昇順でソート
            caseInsensitive: true, // 大文字小文字を区別しない
          },
          "newlines-between": "always", // グループ間に空行を入れる
        },
      ],
    },
  },
];

export default eslintConfig;
