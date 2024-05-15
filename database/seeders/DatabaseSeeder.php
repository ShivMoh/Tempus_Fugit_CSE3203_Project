<?php

namespace Database\Seeders;

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
        // // Insert items into the items table
        // DB::table('items')->insert([
        //     [
        //         "id"            => '79f9eef4-b689-4f13-895a-69f1488a791b',
        //         'name'          => 'Screwdriver',
        //         'selling_price' => 100.0,
        //         'cost_price'    => 80.0,
        //         'total_sold'    => 5,
        //         'stock_count'   => 20,
        //         'image_url'     => "screwdriver_url",
        //         'category_id'   => '174779ab-5a6e-4aee-8053-2822954611d2',
        //         'supplier_id'   => '79f9eef4-b689-4f13-895a-69f1488a791b', // Replace with actual supplier_id
        //         'created_at'    => DB::raw('CURRENT_TIMESTAMP'),
        //         'updated_at'    => DB::raw('CURRENT_TIMESTAMP')
        //     ],
        //     [
        //         "id"            => (string) Str::uuid(),
        //         'name'          => 'Hammer',
        //         'selling_price' => 150.0,
        //         'cost_price'    => 120.0,
        //         'total_sold'    => 10,
        //         'stock_count'   => 15,
        //         'image_url'     => "hammer_url",
        //         'category_id'   => '174779ab-5a6e-4aee-8053-2822954611d2',
        //         'supplier_id'   => '79f9eef4-b689-4f13-895a-69f1488a791b', // Replace with actual supplier_id
        //         'created_at'    => DB::raw('CURRENT_TIMESTAMP'),
        //         'updated_at'    => DB::raw('CURRENT_TIMESTAMP')
        //     ],
        //     [
        //         "id"            => (string) Str::uuid(),
        //         'name'          => 'Wrench',
        //         'selling_price' => 120.0,
        //         'cost_price'    => 90.0,
        //         'total_sold'    => 8,
        //         'stock_count'   => 25,
        //         'image_url'     => "wrench_url",
        //         'category_id'   => '174779ab-5a6e-4aee-8053-2822954611d2',
        //         'supplier_id'   => '79f9eef4-b689-4f13-895a-69f1488a791b', // Replace with actual supplier_id
        //         'created_at'    => DB::raw('CURRENT_TIMESTAMP'),
        //         'updated_at'    => DB::raw('CURRENT_TIMESTAMP')
        //     ]
        // ]);

        // DB::table('addresses')->insert([
        //     [
        //         'id' => (string) Str::uuid(),
        //         'line_1' => '123 Main St',
        //         'line_2' => 'Apt 4B',
        //         'city' => 'Springfield',
        //         'state' => 'IL',
        //         'country' => 'USA',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ]
        // ]);

        // DB::table('employees')->insert([
        //     [
        //         'id' => (string) Str::uuid(),
        //         'first_name' => 'John',
        //         'last_name' => 'Doe',
        //         'dob' => '1980-01-01',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //         'job_role_id' => 'd6353dd9-2e4a-4a21-81c4-9a4f16cef20c',
        //         'contact_id' => '421e6b9c-61e3-444f-8972-c934edf987e2',
        //         'address_id' => '61d49959-a75b-4ad9-90a8-0947ae9e73ae'
        //     ]
        // ]);

        // DB::table('customers')->insert([
        //     [
        //         'id' => (string) Str::uuid(),
        //         'first_name' => 'John',
        //         'last_name' => 'Doe',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //         'contact_id' => '421e6b9c-61e3-444f-8972-c934edf987e2'
        //     ]
        // ]);

        // DB::table('bills')->insert([
        //     [
        //         'id' => (string) Str::uuid(),
        //         'gross_cost' => rand(100, 1000),
        //         'net_cost' => rand(80, 800),
        //         'discount' => rand(0, 20),
        //         'duty_and_vat' => rand(10, 100),
        //         'delivery_free' => rand(0, 50),
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //         'employee_id' => 'cee11fdf-13df-4ce3-947f-ff59500b805f',
        //         'customer_id' => '4d2c6e62-8dae-4109-a6d4-a456c15732d4'
        //     ]
        // ]);

        // // Insert transactions into the transactions table
        // DB::table('transactions')->insert([
        //     [
        //         "id"            => (string) Str::uuid(),
        //         'count'         => 10,
        //         'total_cost'    => 30000.00,
        //         'created_at'    => DB::raw('CURRENT_TIMESTAMP'),
        //         'updated_at'    => DB::raw('CURRENT_TIMESTAMP'),
        //         'item_id'       => '9d989e03-d9fa-4ded-a2bf-f8a0637ca78b',
        //         'bill_id'       => 'f5309d35-2950-4018-81f2-b9fc1739d3f6'
        //     ]
            // [
            //     "id"            => (string) Str::uuid(),
            //     'count'         => 5,
            //     'total_cost'    => 12000.00,
            //     'created_at'    => DB::raw('CURRENT_TIMESTAMP'),
            //     'updated_at'    => DB::raw('CURRENT_TIMESTAMP'),
            //     'item_id'       => '79f9eef4-b689-4f13-895a-69f1488a791b',
            //     'bill_id'       => 'f5309d35-2950-4018-81f2-b9fc1739d3f6'
            // ]
        // ]);
    }
}
