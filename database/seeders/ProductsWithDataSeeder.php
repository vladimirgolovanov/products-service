<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Country;
use App\Models\Product;
use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsWithDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::factory(5)->create();
        Country::factory(5)->create();
        Status::create(['id' => Status::APPROVED, 'name' => 'Approved']);
        Status::create(['id' => Status::PENDING, 'name' => 'Pending']);
        Status::create(['id' => Status::DECLINED, 'name' => 'Declined']);
        Product::factory(10)->create();
        Product::factory(5)->create([
            'status_id' => Status::PENDING,
        ]);
        Product::factory(3)->create([
            'status_id' => Status::DECLINED,
        ]);
    }
}
