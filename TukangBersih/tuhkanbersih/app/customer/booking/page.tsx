"use client"

import { useRouter } from "next/navigation"

const BookingPage = () => {
    const router = useRouter()

    return (
        <div>
            <button onClick={()=>router.push("/customer/booking/createBooking")}>Buat Pesanan</button>
        </div>
    )
}

export default BookingPage;