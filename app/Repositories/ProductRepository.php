<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\Status;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ProductRepository implements ProductRepositoryInterface
{
    public function __construct(private readonly Product $product) {}

    public function getProducts(): Collection
    {
        return $this->product
            ->with('category')
            ->select([
                'id',
                'name',
                'category_id',
                'created_at',
            ])
            ->get()
            ->transform(function (Product $product) {
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'category' => $product->category->name,
                    'created_at' => $product->created_at->format('Y-m-d H:i:s'),
                ];
            });
    }

    public function getProductDropdown(): Collection
    {
        return $this->product
            ->approved()
            ->select([
                'id',
                'name',
            ])
            ->get();
    }

    public function getProduct(string $id): ?Product
    {
        $product = $this->product->find($id);
        if (!$product) {
            return null;
        }

        return $product;
    }

    public function createProduct(array $data): Product
    {
        return $this->product->create($data);
    }

    public function updateProduct(string $id, array $data): Product
    {
        $product = $this->product->find($id);
        $product->update($data);

        return $product;
    }

    public function deleteProduct(string $id): void
    {
        $this->product->find($id)->delete();
    }
}
