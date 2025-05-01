"use client";

import { useEffect, useState } from "react";

import { useBroadcast } from "@/features/chat/hooks/useBroadcast";
import { Message } from "@/features/chat/types/Message";

export default function Client() {
  const [messages, setMessages] = useState<Message[]>([]);
  const { message } = useBroadcast();

  useEffect(() => {
    if (message) {
      setMessages((prev) => [...prev, message]);
    }
  }, [message]);

  return (
    <>
      <h1>Chat</h1>
      <div className="flex flex-col h-screen">
        <div>
          {messages.map((message, index) => (
            <p key={index}>{message.content}</p>
          ))}
        </div>
      </div>
      <div>
        <input type="text" />
        <button>Send</button>
      </div>
    </>
  );
}
