"use client"

import { useRouter } from "next/navigation"
import { useEffect } from "react"
import { useAuth } from "@/lib/AuthContext"
import LogoutButton from "@/components/logoutButton"

const DashboardAdminPage = () => {
    const router = useRouter()
    const {user, loading} = useAuth()
    
    useEffect(() => {
    if (!loading && !user) {
        router.push("/login")
    }    
    if(!loading && user?.role !== "ADMIN"){
        router.push("/login")
    }
    },[user,loading, router] ) // ini fungsinya agar tidak melakukan ini setiap render, hanya melakukannya setiap user dan loading berubah
    return(
        <div>
            <p>Hallo disini merupakah dashboard admin</p>
            <LogoutButton/>
        </div>
    )
}

export default DashboardAdminPage;