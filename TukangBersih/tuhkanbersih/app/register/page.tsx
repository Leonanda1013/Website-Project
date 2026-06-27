"use client";

import { useState } from "react";
import { createUserWithEmailAndPassword } from "firebase/auth";
import { doc, setDoc } from "firebase/firestore";
import { auth, db } from "../../lib/firebase";
import { useRouter } from "next/navigation";

const RegisterPage = () => {
  const router = useRouter();
  const [name, setName] = useState("");
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const [role, setRole] = useState<"CUSTOMER" | "MITRA">("CUSTOMER");
  const [error, setError] = useState("");
  const [loading, setLoading] = useState(false);

  const handleRegister = async () => {
    setLoading(true);
    setError("");

    try {
      // 1. Buat akun di firebase auth
      const useCredential = await createUserWithEmailAndPassword(auth, email, password);
      const uid = useCredential.user.uid;

      // 2. Simpan data tambahan di firestore
      await setDoc(doc(db, "users", uid), {
        name,
        email,
        role,
        phone: "",
        createdAt: new Date(),
      });

      //  3. Kalau role MITRA, buat dokumen di koleksi mitras juga
      if (role === "MITRA") {
        await setDoc(doc(db, "mitras", uid), {
          userId: uid,
          isActive: true,
        });
      }

      // 4. Redirect sesuai role
      if (role === "CUSTOMER") router.push("/dashboard/customer");
      if (role === "MITRA") router.push("/dashboard/mitra");
    } catch (err) {
      if (err instanceof Error) {
        setError(err.message);
      } else {
        setError("Terjadi kesalahan");
      }
    } finally {
      setLoading(false);
    }
  };

  return (
    <div>
      <h1>Register tuhKanBersih</h1>

      <div>
        <label>Nama</label>
        <input type="text" value={name} onChange={(e) => setName(e.target.value)} />
      </div>

      <div>
        <label>Email</label>
        <input type="email" value={email} onChange={(e) => setEmail(e.target.value)} />
      </div>

      <div>
        <label>Password</label>
        <input type="password" value={password} onChange={(e) => setPassword(e.target.value)} />
      </div>

      <div>
        <label>Daftar Sebagai</label>
        <select value={role} onChange={(e) => setRole(e.target.value as "CUSTOMER" | "MITRA")}>
          <option value="CUSTOMER">Customer</option>
          <option value="MITRA">Mitra</option>
        </select>
      </div>

      {error && <p style={{ color: "red" }}>{error}</p>}

      <button onClick={handleRegister} disabled={loading}>
        {loading ? "Mendaftar..." : "Register"}
      </button>

      <p>
        Sudah punya akun? <a href="/login">Login disini</a>
      </p>
    </div>
  );
};

export default RegisterPage;
