<?php

use Database\Seeders\AdminSeeder;
use Database\Seeders\ProductsWithDataSeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Artisan::call('db:seed', [
            '--class' => AdminSeeder::class,
        ]);
        Artisan::call('db:seed', [
            '--class' => ProductsWithDataSeeder::class,
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // truncate tables
        DB::table('categories')->truncate();
        DB::table('countries')->truncate();
        DB::table('statuses')->truncate();
        DB::table('products')->truncate();
        DB::table('users')->truncate();
    }
};
