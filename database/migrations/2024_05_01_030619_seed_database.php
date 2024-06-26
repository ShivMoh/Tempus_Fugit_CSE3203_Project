<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('contacts')->insert(
            array(
                "id"=>"4c2b9326-bef5-4871-8e9a-9c12bccbb2d2",
                "primary_number"=>"3535355",
                "secondary_number"=>"3r53r33",
                "email"=>"supplier1@email.com",
                'created_at'=>DB::raw('CURRENT_TIMESTAMP'),
                'updated_at'=>DB::raw('CURRENT_TIMESTAMP')
            )
        );


        DB::table('contacts')->insert(
            array(
                "id"=>"fceecee3-6ea5-41aa-bf30-fd80446a55cf",
                "primary_number"=>"356355",
                "secondary_number"=>"783r33",
                "email"=>"supplier2@email.com",
                'created_at'=>DB::raw('CURRENT_TIMESTAMP'),
                'updated_at'=>DB::raw('CURRENT_TIMESTAMP')
            )
        );


        DB::table('contacts')->insert(
            array(
                "id"=>"421e6b9c-61e3-444f-8972-c934edf987e2",
                "primary_number"=>"839355",
                "secondary_number"=>"5453r33",
                "email"=>"supplier3@email.com",
                'created_at'=>DB::raw('CURRENT_TIMESTAMP'),
                'updated_at'=>DB::raw('CURRENT_TIMESTAMP')
            )
        );

        DB::table('suppliers')->insert(
            array(
                "id"=>"79f9eef4-b689-4f13-895a-69f1488a791b",
                'name'=>'Supplier 1',
                "description"=>"This is supplier 1. They supply x, y and z",
                "contact_id"=>"4c2b9326-bef5-4871-8e9a-9c12bccbb2d2",
                "image_url"=>"/images/supplier/manufacturing_1.jpg",
                "insurance_fee"=>10000.0,
                "processing_fee"=>10000.0,
                "shipping_fee"=>500.0,
                'created_at'=>DB::raw('CURRENT_TIMESTAMP'),
                'updated_at'=>DB::raw('CURRENT_TIMESTAMP')
            )
        );

        DB::table('suppliers')->insert(
            array(
                "id"=>(string) Str::uuid(),
                'name'=>'Supplier 2',
                'description'=>'This is supplier 2. They supply x, y, z',
                'contact_id'=>"fceecee3-6ea5-41aa-bf30-fd80446a55cf",
                "image_url"=>"/images/supplier/manufacturing_2.jpg",
                "insurance_fee"=>10000.0,
                "processing_fee"=>10000.0,
                "shipping_fee"=>500.0,
                'created_at'=>DB::raw('CURRENT_TIMESTAMP'),
                'updated_at'=>DB::raw('CURRENT_TIMESTAMP')
            )
        );

        DB::table('suppliers')->insert(
            array(
                "id"=>(string) Str::uuid(),
                'name'=>'Supplier 3',
                'description'=>'This is supplier 3. They supply x, y, z',
                'contact_id'=>'421e6b9c-61e3-444f-8972-c934edf987e2',
                "image_url"=>"/images/supplier/manufacturing_3.jpg",
                "insurance_fee"=>10000.0,
                "processing_fee"=>10000.0,
                "shipping_fee"=>500.0,
                'created_at'=>DB::raw('CURRENT_TIMESTAMP'),
                'updated_at'=>DB::raw('CURRENT_TIMESTAMP')
            )
        );


        DB::table('categories')->insert(
            array(
                "id"=>"174779ab-5a6e-4aee-8053-2822954611d2",
                "name"=>"category_1",
                'created_at'=>DB::raw('CURRENT_TIMESTAMP'),
                'updated_at'=>DB::raw('CURRENT_TIMESTAMP')
            )
        );

        DB::table('items')->insert(
            array(
                "id"            => 'a2839025-3c91-4cfe-ad33-1268d16753a8',
                'name'          => 'Hammer',
                'selling_price' => 200.0,
                'cost_price'    => 170.0,
                'total_sold'    => 10,
                'stock_count'   => 20,
                'image_url'     => "https://www.idealind.com/content/dam/canada/sku-images/35-210_01.jpg",
                'category_id'   => '174779ab-5a6e-4aee-8053-2822954611d2',
                'supplier_id'   => '79f9eef4-b689-4f13-895a-69f1488a791b',
                'created_at'    => DB::raw('CURRENT_TIMESTAMP'),
                'updated_at'    => DB::raw('CURRENT_TIMESTAMP')
            )
        );

        DB::table('items')->insert(
            array(
                "id"            => '79f9eef4-b689-4f13-895a-69f1488a791b',
                'name'          => 'Screwdriver',
                'selling_price' => 100.0,
                'cost_price'    => 80.0,
                'total_sold'    => 5,
                'stock_count'   => 20,
                'image_url'     => "https://images.thdstatic.com/productImages/d5b07d03-5d3e-41b4-a52f-ba222380bcbf/svn/stanley-phillips-head-screwdrivers-stht60038-64_1000.jpg",
                'category_id'   => '174779ab-5a6e-4aee-8053-2822954611d2',
                'supplier_id'   => '79f9eef4-b689-4f13-895a-69f1488a791b',
                'created_at'    => DB::raw('CURRENT_TIMESTAMP'),
                'updated_at'    => DB::raw('CURRENT_TIMESTAMP')
            )
        );

        DB::table('items')->insert(
            array(
                "id"            => '79f9eef4-b689-4f13-895a-69f1488a791a',
                'name'          => 'Shovel',
                'selling_price' => 250.0,
                'cost_price'    => 20.0,
                'total_sold'    => 1,
                'stock_count'   => 20,
                'image_url'     => "http://t1.gstatic.com/licensed-image?q=tbn:ANd9GcSBszZ32cdG9gKEs7gL64FtZg04L3tP8Bhil0oxzWFsA-HppSDc06Iu8K3GWGapEI4xUWfLnlqYxyrkFY1k4uE",
                'category_id'   => '174779ab-5a6e-4aee-8053-2822954611d2',
                'supplier_id'   => '79f9eef4-b689-4f13-895a-69f1488a791b',
                'created_at'    => DB::raw('CURRENT_TIMESTAMP'),
                'updated_at'    => DB::raw('CURRENT_TIMESTAMP')
            )
        );

        // company card

        DB::table('cards')->insert(
            array(
                "id"=>"d625a5d9-7277-46df-8c5e-970e8770ab67",
                "card_holder"=>"Tempus Fugit LTD",
                "card_number"=>"343434343434",
                "security_pin"=>"323",
                "expirary_date"=>Carbon::createFromDate("2025", 1, 1),
                "company_card"=>true,
                'created_at'=>DB::raw('CURRENT_TIMESTAMP'),
                'updated_at'=>DB::raw('CURRENT_TIMESTAMP')
            )
        );

        DB::table('addresses')->insert(
            array(
                "id"=>"2d9d32a9-0d08-43c0-a0a5-48f9d5d9aad2",
                "line_1"=>"Address Line",
                "line_2"=>"Address Line 2",
                "city"=>"Georgetown",
                "state"=>"Guyana",
                "country"=>"Guyana",
                "company_address"=>false,
                'created_at'=>DB::raw('CURRENT_TIMESTAMP'),
                'updated_at'=>DB::raw('CURRENT_TIMESTAMP')
            )
        );

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('contacts')->truncate();
        DB::table('suppliers')->truncate();
        DB::table('categories')->truncate();
        DB::table('items')->truncate();
        DB::table('cards')->truncate();

    }
};
