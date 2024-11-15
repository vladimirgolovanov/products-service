<?php
declare(strict_types=1);

namespace App\Events;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ProductUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public Product $product)
    {
    }

    public function broadcastOn(): array
    {
        return [
            new Channel('products')
        ];
    }

    public function broadcastWith(): array
    {
        return [
            'product' => ProductResource::make($this->product),
        ];
    }

    public function broadcastAs(): string
    {
        return 'product.updated';
    }
}
