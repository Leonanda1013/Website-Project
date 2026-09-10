<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Product\StoreProductRequest;
use App\Services\ProductService;
use App\Http\Resources\ProductResource;
use App\Helpers\ResponseHelper;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests\Product\UpdateProductRequest;

class ProductController extends Controller
{
    public function __construct(
        private readonly ProductService $productService
    ){}

    public function index(): JsonResponse
    {
        try{
            $products = $this->productService->getAllProducts();
            return ResponseHelper::paginate(ProductResource::collection($products));
        } catch (\Exception $e){
            Log::error('ProductController@index: ' . $e->getMessage());
            return ResponseHelper::error('Gagal mengambil data product.', 500);
        }
    }

     public function store(StoreProductRequest $request): JsonResponse
    {
        try {
            $product = $this->productService->createProduct($request->validated());
            return ResponseHelper::success(new ProductResource($product), 'Produk berhasil dibuat.', 201);
        } catch (\Exception $e) {
            Log::error('ProductController@store: ' . $e->getMessage());
            return ResponseHelper::error('Gagal membuat produk.', 500);
        }
    }

    /*
        * Menampilan detail satu produk berdasarkan ID.
        *
        * @param int $id ID dari produk yang ingin dilihat
        * @return JsonResponse
    */

    public function show(int $id): JsonResponse
    {
        try {
            $product = $this->productService->getProductById($id);

            return ResponseHelper::success(
                new ProductResource($product),
                'Data produk berhasil diambil.'
            );
        } catch (ModelNotFoundException $e){
            return ResponseHelper::error('Produk tidak ditemukan.', 404);
        } catch (\Exception $e) {
            Log::error('ProductController@show: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            return ResponseHelper::error('Gagal mengambil data produk.', 500);
        }
    }

    /* Memperbarui data produk

    @param UpdateProductRequest $request
    @param int $id
    @return JsonResponse

    */

    public function update(UpdateProductRequest $request, int $id): JsonResponse
    {
        try {
            $product = $this->productService->updateProduct($id, $request->validated());

            return ResponseHelper::success(
                new ProductResource($product),
                'Produk berhasil diperbarui.'
            );
        } catch (ModelNotFoundException $e) {
            return ResponseHelper::error('Produk tidak ditemukan.', 404);
        } catch (\Exception $e) {
            Log::error('ProductController@update: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            return ResponseHelper::error('Gagal memperbarui produk.', 500);
        }
    }

/*
    Menhapus produk dari sistem.

    @param int $id
    @return JsonResponse
*/

    public function destroy(int $id): JsonResponse
    {
        try {
            $this->productService->deleteProduct($id);

            return ResponseHelper::success(null, 'Produk berhasil dihapus.');
        } catch (ModelNotFoundException $e) {
            return ResponseHelper::error('Produk tidak ditemukan.', 404);
        } catch (\Exception $e) {
            Log::error('ProductController@destroy: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            return ResponseHelper::error('Gagal menghapus produk.', 500);
        }
    }

}

