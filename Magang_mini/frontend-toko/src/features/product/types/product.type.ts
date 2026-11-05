/* 
    Bentuk data satu product tunggal
    Sesuai dengan ProductResource dari Laravel
*/

export interface Product {
    id: number;
    name: string;
    description: string | null;
    price: number;
    stock: number;
    created_at?: string;
}

/* 
    Format standar response sukses dari ResponseHelper Laravel.
*/

export interface ApiResponse<T> {
    status: boolean;
    message: string;
    data: T;
}

/* 
    Format response paginasi dari ResponseHelper::paginate() Laravel.
*/
export interface PaginationResponse<T> {
    status: boolean;
    message: string;
    data: T[];
    pagination: {
        current_page: number;
        per_page: number;
        total: number;
        last_page: number;
    };
}

/* 
    Data yang dikirim dari form Frontend saat menambah/mengedit produk.
*/

export interface ProductFormPayLoad {
    name: string;
    description?: string;
    price: number;
    stock: number;
}