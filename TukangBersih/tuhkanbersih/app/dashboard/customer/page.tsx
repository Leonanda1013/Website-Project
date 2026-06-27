"use client"

import { signOut } from "firebase/auth";
import { auth } from "@/lib/firebase";
import { useRouter } from "next/navigation";

const DashboardCustomer = () => {
  const router = useRouter();
  const handleLogout = async () => {
    await signOut(auth);
    document.cookie = "session=; path=/; max-age=0"; // hapus cookie
    router.push("/login");
  };
  return (
    <button onClick={handleLogout}>
      Logout
    </button>
  );
};

export default DashboardCustomer
