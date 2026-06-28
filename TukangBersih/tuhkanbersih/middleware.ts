import { NextResponse } from "next/server";
import type { NextRequest } from "next/server";


export function middleware(request: NextRequest) {
  const session = request.cookies.get("session")?.value;
  const { pathname } = request.nextUrl;

  // kalau belum login, maka protected dengan pindah ke halaman login
  if (!session) {
    if (pathname.startsWith("/dashboard") || pathname.startsWith("/booking")) {
      return NextResponse.redirect(new URL("/login", request.url));
    }
  }

  if(session){
    if(pathname==="/login"||pathname==="/register"){
        return NextResponse.redirect(new URL("/", request.url))
    }
  }

  return NextResponse.next()
}

export const config = {
    matcher: ["/dashboard/:path*", "/booking/:path*", "/login", "/register"],
}
