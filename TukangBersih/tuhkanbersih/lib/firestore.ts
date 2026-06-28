import { collection, doc, addDoc, getDocs, updateDoc, deleteDoc, query, where, orderBy, Timestamp } from "firebase/firestore";

import { db } from "./firebase";

// SERVICES

export const getServices = async () => {
  const q = query(collection(db, "services"), where("isActive", "==", true));
  const snapshot = await getDocs(q);
  return snapshot.docs.map((doc) => ({ id: doc.id, ...doc.data() }));
};

export const createService = async (data: { name: string; description: string; price: number; durationHr: number }) => {
  return await addDoc(collection(db, "services"), {
    ...data,
    isActive: true,
  });
};

export const updateService = async (
  id: string,
  data: Partial<{
    name: string;
    description: string;
    price: number;
    durationHr: number;
    isActive: boolean;
  }>,
) => {
  return await updateDoc(doc(db, "services, id"), data);
};

export const deleteService = async (id: string) => {
  return await updateDoc(doc(db, "service", id), { isActive: false });
};

// Booking

export const createBooking = async (data: { customerId: string; serviceId: string; address: string; scheduleAt: Date; totalPrice: number }) => {
  return await addDoc(collection(db, "bookings"), {
    ...data,
    mitraId: null,
    status: "PENDING",
    paymentStatus: "UNPAID",
    snapToken: null,
    scheduleAt: Timestamp.fromDate(data.scheduleAt),
    createAt: Timestamp.now(),
  });
};

export const getBookingByMitra = async (mitraId: string) => {
  const q = query(collection(db, "bookings"), where("mitraId", "==", mitraId), orderBy("createAt", "desc"));
  const snapshot = await getDocs(q);
  return snapshot.docs.map((doc) => ({ id: doc.id, ...doc.data() }));
};

export const getPendingBooking = async () => {
  const q = query(collection(db, "bookings"), where("status", "==", "PENDING"), orderBy("createdAt", "desc"));
  const snapshot = await getDocs(q);
  return snapshot.docs.map((doc) => ({ id: doc.id, ...doc.data() }));
};

export const updateBookingStatus = async (id: string, status: "CONFIRMED" | "ON_THE_WAY" | "CLEANING" | "DONE" | "CANCELLED") => {
  return await updateDoc(doc(db, "bookings", id), { status });
};

export const updatePaymentStatus = async (id: string, paymentStatus: "PAID" | "FAILED", snapToken?: string) => {
  return await updateDoc(doc(db, "bookings", id), { paymentStatus, snapToken });
};

// MITRAS

export const getMitras = async () => {
  const snapshot = await getDocs(collection(db, "mitras"));
  return snapshot.docs.map((doc) => ({ id: doc.id, ...doc.data() }));
};

export const toggleMitraActive = async (uid: string, isActive: boolean) => {
  return await updateDoc(doc(db, "mitras", uid), { isActive });
};
