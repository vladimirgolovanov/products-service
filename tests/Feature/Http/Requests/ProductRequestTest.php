<?php
declare(strict_types=1);

namespace Tests\Feature\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ProductRequestTest extends TestCase
{
    use DatabaseMigrations;

    public static function successCaseDataProvider(): array
    {
        return [
            'basic fields' => ['Product Name', 'Product Description', 1, 1, 1],
        ];
    }

    #[Test]
    #[DataProvider('successCaseDataProvider')]
    public function test_product_request($name, $description, $categoryId, $statusId, $countryId): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $this->postJson(route('products.store'), [
            'name' => $name,
            'description' => $description,
            'category_id' => $categoryId,
            'status_id' => $statusId,
            'country_id' => $countryId,
        ])->assertStatus(201);
    }

    public static function failedCaseDataProvider(): array
    {
        return [
            'empty product name' => ['', 'Product Description', 1, 1, 1],
            'empty description' => ['Product Name', '', 1, 1, 1],
            'empty category' => ['Product Name', 'Product Description', '', 1, 1],
            'zero category' => ['Product Name', 'Product Description', 0, 1, 1],
            'empty status' => ['Product Name', 'Product Description', 1, '', 1],
            'zero status' => ['Product Name', 'Product Description', 1, 0, 1],
            'empty country' => ['Product Name', 'Product Description', 1, 1, ''],
            'zero country' => ['Product Name', 'Product Description', 1, 1, 0],
        ];
    }

    #[Test]
    #[DataProvider('failedCaseDataProvider')]
    public function test_product_request_validation($name, $description, $categoryId, $statusId, $countryId): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $this->postJson(route('products.store'), [
            'name' => $name,
            'description' => $description,
            'category_id' => $categoryId,
            'status_id' => $statusId,
            'country_id' => $countryId,
        ])->assertStatus(422);
    }
}
