<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // DB::table('items')->insert(
        //     array(
        //         "id"            => (string) Str::uuid(),
        //         'name'          => 'Screwdriver',
        //         'selling_price' => 100.0,
        //         'cost_price'    => 80.0,
        //         'total_sold'    => 5,
        //         'stock_count'   => 20,
        //         'image_url'     => "screwdriver_url",
        //         'category_id'   => '174779ab-5a6e-4aee-8053-2822954611d2',
        //         'supplier_id'   => '79f9eef4-b689-4f13-895a-69f1488a791b',
        //         'created_at'    => DB::raw('CURRENT_TIMESTAMP'),
        //         'updated_at'    => DB::raw('CURRENT_TIMESTAMP')
        //     )
        // );

    }
}
