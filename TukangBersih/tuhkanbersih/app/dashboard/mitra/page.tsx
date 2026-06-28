"use client";

import { useEffect } from "react";
import { useAuth } from "@/lib/AuthContext";
import LogoutButton from "@/components/logoutButton";
import { useRouter } from "next/router";

const DashboardMitra = () => {
  const { user, loading } = useAuth();
  const router = useRouter();

  useEffect(() => {
    if (!loading && !user) router.push("/login");
    if (!loading && user?.role !== "MITRA") router.push("/login");
  });

  return (
    <div>
      <p>Ini adalah dashboard mitra</p>
      <LogoutButton />
    </div>
  );
};

export default DashboardMitra;
