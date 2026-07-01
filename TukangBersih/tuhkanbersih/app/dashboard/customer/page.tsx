"use client";
import { useAuth } from "@/lib/AuthContext";
import { useRouter } from "next/navigation";
import { useEffect } from "react";
import LogoutButton from "@/components/logoutButton";

const DashboardCustomer = () => {
  const { user, loading } = useAuth();
  const router = useRouter();

  useEffect(() => {
    if (!loading && !user) router.push("/login");
    if (!loading && user?.role !== "CUSTOMER") router.push("/login");
  },[user,loading, router]);

  if (loading) return <p>Loading...</p>;
  return (
    <div>
      <h1>Dashboard Customer</h1>
      <p>Hallo {user?.name}</p>
      <p>Apakah anda ingin melihat hal yang berih hari ini?</p>
      <button onClick={()=>router.push("/dashboard/customer/services")}>Ayo Bersihkan</button>
      <LogoutButton />
    </div>
  );
};

export default DashboardCustomer;
