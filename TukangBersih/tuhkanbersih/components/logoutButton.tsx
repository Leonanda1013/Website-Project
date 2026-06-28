import { signOut } from "firebase/auth";
import { auth } from "@/lib/firebase";
import { useRouter } from "next/navigation";
const LogoutButton = () => {
    const router = useRouter()
    const handleLogout = async () =>{
        await signOut(auth);
        document.cookie = "session=; path=/; max-age=0;";
        router.push("/login");
    }

    return(
        <div>
            <button onClick={handleLogout}>Logout</button>
        </div>
    )
}

export default LogoutButton;