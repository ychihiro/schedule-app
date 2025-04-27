import { http } from "@/lib/fetch";

export const createChatMessage = async (message: string) => {
  const response = await http("/chat-messages", "POST", {
    requestBody: { message },
  });
  return response;
};
