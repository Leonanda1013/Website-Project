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
}
