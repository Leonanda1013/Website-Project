"use client"

import { useState } from "react";
import {signInWithEmailAndPassword} from "firebase/auth"
import { db , auth } from "../../lib/firebase";
import { useRouter } from "next/navigation";
import { doc, getDoc } from "firebase/firestore";

const LoginPage = () => {
    const router = useRouter()
    const [email, setEmail] = useState("")
    const [password, setPassword] = useState("")
    const [error, setError] = useState("")
    const [loading, setLoading] = useState(false)

    const handleLogin = async () => {
        setLoading(true)
        setError("")
        try{
            // 1. Login dengan firebase auth
            const userCredential = await signInWithEmailAndPassword(auth, email, password)
            const uid = userCredential.user.uid

            // 2. Ambil role dari firestore
            const docSnap = await getDoc(doc(db, "users", uid))

            if (docSnap.exists()){
                const role = docSnap.data().role
                
                document.cookie = `session=${uid}; path=/; max-age=86400`//1hari
                if(role === "CUSTOMER")router.push("/dashboard/cutomer")
                if(role === "ADMIN")router.push("/dashboard/admin")
                if(role === "MITRA")router.push("/dashboard/mitra")
            }
        }catch (err){
            if (err instanceof Error){
                setError(err.message)
            }else{
                setError("Terjadi Kesalahan")
            }
        }finally{
            setLoading(false)
        }
    }
    return(
        <div>
            <h1>Login TuhKanBersih</h1>

            <div>
                <label>Email</label>
                <input 
                type="email"
                value={email}
                onChange={(e)=> setEmail(e.target.value)}
                />
            </div>
            <div>
                <label>Password</label>
                <input
                type="password"
                value={password}
                onChange={(e)=>setPassword(e.target.value)}
                />
            </div>

            {error &&  <p style={{color:"red"}}>{error}</p>}

            <button onClick={handleLogin} disabled={loading}>
                {loading ? "Loading..." : "Login"}
            </button>

            <p>
                <a href="/register">Belum punya akun? Register dinisi</a>
            </p>
        </div>
    )
}

export default LoginPage