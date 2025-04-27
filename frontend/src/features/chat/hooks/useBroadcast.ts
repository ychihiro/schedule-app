import Pusher from "pusher-js";
import { useEffect, useState } from "react";

import { PUSHER_KEY } from "@/constants/env";

import { Message } from "../types/Message";

export const useBroadcast = () => {
  const [message, setMessage] = useState<Message>();

  useEffect(() => {
    if (!PUSHER_KEY) {
      throw new Error("PUSHER_KEY is not defined");
    }

    Pusher.logToConsole = true;
    const pusher = new Pusher(PUSHER_KEY, { cluster: "ap3" });
    const channel = pusher.subscribe("chat-room-channel");

    channel.bind("create-chat-message", (data: { message: Message }) => {
      setMessage(data.message);
    });

    return () => {
      channel.unbind("create-chat-message");
      pusher.unsubscribe("chat-room-channel");
    };
  }, []);

  return { message };
};
