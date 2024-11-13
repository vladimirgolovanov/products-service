<?php

namespace tests\Feature\Models;

use App\Models\Product;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use DatabaseMigrations;

    public function test_create(): void
    {
        $product = Product::factory()->create();

        $this->assertDatabaseHas('products', $product->toArray());
    }

    public function test_update(): void
    {
        $product = Product::factory()->create();
        $product->name = 'New Name';
        $product->save();

        $this->assertDatabaseHas('products', $product->toArray());

        $product->update(['name' => 'Another Name']);
        $this->assertDatabaseHas('products', ['id' => $product->id, 'name' => 'Another Name']);
    }
}
