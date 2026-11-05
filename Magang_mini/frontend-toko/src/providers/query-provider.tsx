"use client";

import { QueryClient, QueryClientProvider } from "@tanstack/react-query";
import { useState } from "react";

/* 
    Provider global untuk Tanstack Query.
    Memastikan cache data server terseda di seluruh komponen aplikasi.
*/

export default function QueryProvider({ children }: { children: React.ReactNode }) {
  // usestate memastikan QueryClient hanya dibuat satu ali per sesi browser
  const [queryClient] = useState(
    () =>
      new QueryClient({
        defaultOptions: {
          queries: {
            staleTime: 1000 * 60, // Data dianggap segar selama 1 menit (tidak perlu fetch ulang terus menerus)
            retry: 1, // Jika gagal, coba lagi 1 kali
          },
        },
      }),
  );
  return <QueryClientProvider client={queryClient}>{children}</QueryClientProvider>;
}
