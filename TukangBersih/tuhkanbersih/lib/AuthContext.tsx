"use client"

import { createContext, useContext, useEffect, useState } from "react"
import {onAuthStateChanged} from "firebase/auth"
import {doc, getDoc } from "firebase/firestore"
import { auth , db } from "./firebase"

interface AuthUser {
    uid: string
    email: string | null
    name: string | null
    role: "CUSTOMER" | "MITRA" | "ADMIN"
}

interface AuthContextType {
    user: AuthUser | null
    loading: boolean
}

const AuthContext = createContext<AuthContextType>({
    user: null,
    loading: true,
})

export const AuthProvider = ({ children }: {children: React.ReactNode }) => {
    const [user, setUser] = useState<AuthUser | null>(null)
    const [loading, setLoading] = useState(true)

    useEffect(()=> {
        const unsubscribe = onAuthStateChanged(auth, async(firebaseUser)=>{
            if(firebaseUser){
                // ambil data tambahan dari firebase (nama,role)
                const docRef = doc(db, "users", firebaseUser.uid)
                const docSnap = await getDoc(docRef)

                if (docSnap.exists()){
                    const data = docSnap.data()
                    setUser({
                        uid: firebaseUser.uid,
                        email: firebaseUser.email,
                        name: data.name,
                        role: data.role,
                    })
                }
            } else {
                setUser(null)
            }
            setLoading(false)
        })

        return ()=> unsubscribe()
    },[])
    return ( 
        <AuthContext.Provider value={{ user, loading}}>
            {children}
        </AuthContext.Provider>
    )
}

export const useAuth = () => useContext(AuthContext)