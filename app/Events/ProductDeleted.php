<?php
declare(strict_types=1);

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ProductDeleted implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public int $productId)
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
            'product_id' => $this->productId
        ];
    }

    public function broadcastAs(): string
    {
        return 'product.deleted';
    }
}
