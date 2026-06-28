"use client";

import { useEffect } from "react";
import { useAuth } from "@/lib/AuthContext";
import { useRouter } from "next/navigation";

export default function Home() {
  const router = useRouter();
  const { user, loading } = useAuth();

  useEffect(() => {
    if (loading) return;
    if (!user) {
      router.push("/login");
    }
    if (user != null) {
    if (user.role === "ADMIN") router.push("/dashboard/admin");
    if (user.role === "MITRA") router.push("/dashboard/mitra");
    if (user.role === "CUSTOMER") router.push("/dashboard/customer"); 
    }

  });
  return <p>loading...</p>;
}
