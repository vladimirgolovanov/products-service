<?php
declare(strict_types=1);

namespace App\Observers;

use App\Events\ProductCreated;
use App\Events\ProductUpdated;
use App\Events\ProductDeleted;
use App\Models\Product;

class ProductObserver
{
    public function created(Product $product): void
    {
        ProductCreated::dispatch($product);
    }

    public function updated(Product $product): void
    {
        ProductUpdated::dispatch($product);
    }

    public function deleted(Product $product): void
    {
        ProductDeleted::dispatch($product->id);
    }

    public function restored(Product $product): void
    {
    }

    public function forceDeleted(Product $product): void
    {
    }
}
