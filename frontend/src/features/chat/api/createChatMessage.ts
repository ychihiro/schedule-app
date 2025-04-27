import { http } from "@/lib/fetch";

export const createChatMessage = async (content: string) => {
  const response = await http("/chat-messages", "POST", {
    requestBody: { content },
  });
  return response;
};
