<?php
declare(strict_types=1);

namespace App\Repositories;

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

    public function getProduct(string $id): ?array
    {
        $product = $this->product->find($id);
        if (!$product) {
            return null;
        }

        return [
            'id' => $product->id,
            'name' => $product->name,
            'description' => $product->description,
            'category' => $product->category->name ?? null,
            'status' => $product->status->name ?? null,
            'country' => $product->country->name ?? null,
            'user' => $product->user->name ?? null,
            'created_at' => $product->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $product->updated_at->format('Y-m-d H:i:s'),
        ];
    }

    public function createProduct(array $data): Product
    {
        return $this->product->create($data);
    }

    public function updateProduct(string $id, array $data): void
    {
        $this->product->find($id)->update($data);
    }

    public function deleteProduct(string $id): void
    {
        $this->product->find($id)->delete();
    }
}
