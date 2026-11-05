import axios from "axios";
import { env } from "@/shared/config/env";

/* 
    Klient HTTP Axios terpusat untuk komunikasi dengan backend Laravel
*/

export const apiClient = axios.create({
    baseURL: env.apiUrl,
    headers: {
        Accept: "application/json",
        "Content-Type": "application/json",
    },
});