<?php
declare(strict_types=1);

namespace App\Repositories\Contracts;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Support\Collection;

interface ProductRepositoryInterface
{
    public function getProducts(): Collection;
    public function getProductDropdown(): Collection;
    public function getProduct(string $id): ?Product;
    public function createProduct(array $data): Product;
    public function updateProduct(string $id, array $data): Product;
    public function deleteProduct(string $id): void;
}
