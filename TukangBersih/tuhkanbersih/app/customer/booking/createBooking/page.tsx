"use client";

import { useRouter } from "next/navigation";
import { useAuth } from "@/lib/AuthContext";
import { useState, useEffect } from "react";
import { createBooking } from "@/lib/firestore";
import { Timestamp } from "firebase/firestore";

interface Booking {
  customerId: string;
  mitraId: string;
  serviceId: string;
  address: string;
  scheduleat: Timestamp;
  status: "PENDING" | "CONFIRMED" | "";
}

const CreateBookingPage = () => {
  const { user, loading } = useAuth();
  const [loadingBooking, setLoadingBooking] = useState(true);

  return (
    <div>
      <label>Alamat</label>
      <input type="address" value={address} />
    </div>
  );
};
