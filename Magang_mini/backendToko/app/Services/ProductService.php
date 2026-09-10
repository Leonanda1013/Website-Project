<?php

namespace App\Services;

use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductService
{
    public function __construct(
        private readonly ProductRepositoryInterface $productRepository

    ){}

    public function getAllProducts(int $perPage = 15): LengthAwarePaginator
    {
        return $this->productRepository->getAll($perPage);
    }

    public function createProduct(array $data): Product
    {
        return $this->productRepository->create($data);
    }

    /*
        * Mengambil data produk berdasarkan ID.
        *
        * @param int $id ID dari produk yang ingin diambil
        * @return Product
        * @throws ModelNotFoundException
    */
    public function getProductById(int $id): Product
    {
        return $this->productRepository->findOrFail($id);
    }

    /*
        *Memperbarui data produk yang ada.
        *
        * @param int $id ID produk yang akan diupdate
        * @param array $data Data baru hasil validasi Form request
        * @return Product
        * @throws ModelNotFoundException Jika produk tidak ditemukan
    */
    public function updateProduct(int $id, array $data): Product
    {
        $product = $this->productRepository->findOrFail($id);
        $this->productRepository->update($product, $data);


        // $product->fres() mengambil data paling segar dari database setelah di update
        return $product->fresh();
    }
}
