<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
                "id"=>(string) Str::uuid(),
                'name'=>'Random Item',
                'selling_price'=>4.5,
                'cost_price'=>10.0,
                'total_sold'=>10,
                'stock_count'=>20,
                'image_url'=>"sdfdfsdfndsf",
                'category_id'=>'174779ab-5a6e-4aee-8053-2822954611d2',
                'supplier_id'=>'79f9eef4-b689-4f13-895a-69f1488a791b',
                'created_at'=>DB::raw('CURRENT_TIMESTAMP'),
                'updated_at'=>DB::raw('CURRENT_TIMESTAMP')
            )
        );    
        
        DB::table('items')->insert(
            array(
                "id"=>(string) Str::uuid(),
                'name'=>'Random Item 2',
                'selling_price'=>4.5,
                'cost_price'=>10.0,
                'total_sold'=>10,
                'stock_count'=>20,
                'image_url'=>"sdfdfsdfndsf",
                'category_id'=>'174779ab-5a6e-4aee-8053-2822954611d2',
                'supplier_id'=>'79f9eef4-b689-4f13-895a-69f1488a791b',
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
    }
};
