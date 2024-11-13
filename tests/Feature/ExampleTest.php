<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use DatabaseMigrations;

    public function test_products_route(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->get('/products');
        $response->assertStatus(200);
    }
}
