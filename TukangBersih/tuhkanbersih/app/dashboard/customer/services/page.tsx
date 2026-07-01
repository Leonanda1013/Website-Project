"use client";

import { useRouter } from "next/navigation";
import { useEffect, useState } from "react";
import { useAuth } from "@/lib/AuthContext";
import { getServices } from "@/lib/firestore";

interface Service {
  id: string;
  name: string;
  description: string;
  price: number;
  durationHr: number;
}

const ServicesPage = () => {
  const router = useRouter();
  const [loadingServices, setLoadingServices] = useState(true);
  const { user, loading } = useAuth();
  const [services, setServices] = useState<Service[]>([]);

  useEffect(() => {
    if (!loading && !user) router.push("/login");
    if (!loading && user?.role !== "CUSTOMER") router.push("/login");
  }, [user, loading, router]);

  useEffect(() => {
    const fetchServices = async () => {
      const data = await getServices();
      setServices(data as Service[]);
      setLoadingServices(false);
    };
    fetchServices();
  }, []);

  if (loading || loadingServices) return <p>Loading...</p>
  return (
    <div>
      <h1>Pilih Layanan</h1>

      {services.length === 0 && <p>Belum ada layaan tersedia</p>}

      {services.map((service) => (
        <div key={service.id} style={{ border: "1px solid black", margin: "10px", padding: "10px" }}>
          <h2>{service.name}</h2>
          <p>{service.description}</p>
          <p>Harga: Rp {service.price.toLocaleString("id-ID")}</p>
          <p>Durasi: {service.durationHr} jam</p>
          <button onClick={() => router.push(`/dashboard/customer/booking?serviceId=${service.id}&price=${service.price}`)}>Pesan Sekarang</button>
          <button onClick={()=> router.push("/dashboard/customer")}>Back</button>
        </div>
      ))}
    </div>
  );
};

export default ServicesPage;
