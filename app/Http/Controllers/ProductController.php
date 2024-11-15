<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    public function __construct(private ProductRepositoryInterface $repository) {}

    public function index(): JsonResponse
    {
        try {
            return response()->json($this->repository->getProducts());
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function dropdown(): JsonResponse
    {
        try {
            return response()->json($this->repository->getProductDropdown());
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function store(ProductRequest $request): ProductResource|JsonResponse
    {
        try {
            $data = $request->validated();
            $data['user_id'] = auth()->id();
            return ProductResource::make($this->repository->createProduct($data));
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function show(string $id): ProductResource|JsonResponse
    {
        try {
            $product = $this->repository->getProduct($id);
            if (!$product) {
                return response()->json(['error' => 'Product not found'], 404);
            }
            return ProductResource::make($product);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(ProductRequest $request, string $id): ProductResource|JsonResponse
    {
        try {
            $data = $request->validated();
            $product = $this->repository->updateProduct($id, $data);
            return ProductResource::make($product);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy(string $id): JsonResponse
    {
        try {
            $this->repository->deleteProduct($id);
            return response()->json(null, 204);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
