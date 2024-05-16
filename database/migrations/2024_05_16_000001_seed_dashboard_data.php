<?php

use App\Models\Employee;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        // Insert items into the items table
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

        DB::table('addresses')->insert([
            [
                'id' => '2d9d32a9-0d08-43c0-a0a5-48f9d5d9a8c0',
                'line_1' => '123 Main St',
                'line_2' => 'Apt 4B',
                'city' => 'Springfield',
                'state' => 'IL',
                'country' => 'USA',
                'company_address'=>true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        DB::table('addresses')->insert([
            [
                'id' => '3a8b47f7-5b9a-4b19-a4d2-f21e29be2f4f',
                'line_1' => '456 Oak St',
                'line_2' => 'Suite 202',
                'city' => 'Oakland',
                'state' => 'CA',
                'country' => 'USA',
                'company_address' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        DB::table('contacts')->insert([
            [
                'id' => 'c950681e-68e3-4b5b-90e2-7c6e6f8b2121',
                'primary_number' => '555-123-4567',
                'secondary_number' => '555-987-6543',
                'email' => 'mary.sue@example.com',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
        

        DB::table('employees')->insert([
            [
                'id' => 'cee11fdf-13df-4ce3-947f-ff59500b8055',
                'first_name' => 'John',
                'last_name' => 'Doe',
                'dob' => '1980-01-01',
                'unique_identifier' => '1024212',
                'created_at' => now(),
                'updated_at' => now(),
                'job_role_id' => 'd6353dd9-2e4a-4a21-81c4-9a4f16cef20c',
                'contact_id' => '421e6b9c-61e3-444f-8972-c934edf987e2',
                'address_id' => '2d9d32a9-0d08-43c0-a0a5-48f9d5d9a8c0'
            ]
        ]);


        DB::table('employees')->insert([
            [
                'id' => 'bf3f86ab-10e0-4659-9ac5-69ea75889555',
                'first_name' => 'Mary',
                'last_name' => 'Sue',
                'dob' => '1980-08-10',
                'unique_identifier' => '1012342',
                'created_at' => now(),
                'updated_at' => now(),
                'job_role_id' => '8821d316-6ee2-4f70-bfc8-917b4219f7d3',
                'contact_id' => 'c950681e-68e3-4b5b-90e2-7c6e6f8b2121',
                'address_id' => '3a8b47f7-5b9a-4b19-a4d2-f21e29be2f4f'
            ]
        ]);

        DB::table('payments')->insert([
            [
                'id' => 'd625a5d9-7277-46df-8c5e-870e8770ab67',
                'cash' => 1,
                'amount' => 100.00,
                'created_at'    => DB::raw('CURRENT_TIMESTAMP'),
                'updated_at'    => DB::raw('CURRENT_TIMESTAMP'),
            ]
            ]);

        DB::table('card_payments')->insert([
            [
                'id' => 'd625a5d9-7277-46df-8c5e-970e8770ac76',
                'created_at'    => DB::raw('CURRENT_TIMESTAMP'),
                'updated_at'    => DB::raw('CURRENT_TIMESTAMP'),
                'payment_id' => 'd625a5d9-7277-46df-8c5e-870e8770ab67',
                'card_id' => 'd625a5d9-7277-46df-8c5e-970e8770ab67'

            ]
        ]);

        DB::table('customers')->insert([
            [
                'id' => 'd625a5d9-7277-46df-8c5e-870e8770ab66',
                'first_name' => 'John',
                'last_name' => 'Doe',
                'created_at' => now(),
                'updated_at' => now(),
                'contact_id' => '421e6b9c-61e3-444f-8972-c934edf987e2',
                'payment_id' => 'd625a5d9-7277-46df-8c5e-870e8770ab67'
            ]
        ]);

        DB::table('users')->insert([
            'id' => 'cee11fdf-13df-4ce3-947f-ff59500b8055',
            'email' => 'testerdata@gmail.com',
            'password' => '$2y$12$rRdoJgoLCvtKAL4UW.h4UuKoeJd3dU.sJsJEvDH.wZA7aUEslw60i',
            'created_at' => now(),
            'updated_at' => now(),
            'user_role_id' => '86efe04b-8be4-4c70-a240-fe9624d89371',
            'employee_id' => 'cee11fdf-13df-4ce3-947f-ff59500b8055'


        ]);

        DB::table('bills')->insert([
            [
                'id' => 'cee11fdf-13df-4ce3-947f-ff59500b805d',
                'gross_cost' => rand(100, 1000),
                'net_cost' => rand(80, 800),
                'discount' => rand(0, 20),
                'duty_and_vat' => rand(10, 100),
                'delivery_free' => rand(0, 50),
                'created_at' => now(),
                'updated_at' => now(),
                'user_id' => 'cee11fdf-13df-4ce3-947f-ff59500b8055',
                'customer_id' => 'd625a5d9-7277-46df-8c5e-870e8770ab66'
            ]
        ]);

        // Insert transactions into the transactions table
        DB::table('transactions')->insert([
            [
                "id"            => (string) Str::uuid(),
                'count'         => 10,
                'total_cost'    => 30000.00,
                'created_at'    => DB::raw('CURRENT_TIMESTAMP'),
                'updated_at'    => DB::raw('CURRENT_TIMESTAMP'),
                'item_id'       => 'a2839025-3c91-4cfe-ad33-1268d16753a8',
                'bill_id'       => 'cee11fdf-13df-4ce3-947f-ff59500b805d'
            ],
            [
                "id"            => (string) Str::uuid(),
                'count'         => 5,
                'total_cost'    => 12000.00,
                'created_at'    => DB::raw('CURRENT_TIMESTAMP'),
                'updated_at'    => DB::raw('CURRENT_TIMESTAMP'),
                'item_id'       => '79f9eef4-b689-4f13-895a-69f1488a791b',
                'bill_id'       => 'cee11fdf-13df-4ce3-947f-ff59500b805d'
            ]
        ]);
    }


    public function down(): void
    {

    }
};
