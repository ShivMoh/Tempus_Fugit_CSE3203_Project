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
                "id"=>(string) Str::uuid(),
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

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('contacts')->truncate();
        DB::table('suppliers')->truncate();

    }
};
