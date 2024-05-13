<?php

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
        DB::table('user_roles')->insert(
            array(
                'id'=> "eff3a740-b777-48dc-8c04-78893ba6a50b",
                'type'=>'basic',
                'created_at'=>DB::raw('CURRENT_TIMESTAMP'),
                'updated_at'=>DB::raw('CURRENT_TIMESTAMP')
            )
        );

        DB::table('user_roles')->insert(
            array(
                'id'=> "86efe04b-8be4-4c70-a240-fe9624d89371",
                'type'=>'manager',
                'created_at'=>DB::raw('CURRENT_TIMESTAMP'),
                'updated_at'=>DB::raw('CURRENT_TIMESTAMP')
            )
        );

        DB::table('job_roles')->insert(
            array(
                'id'=>"8821d316-6ee2-4f70-bfc8-917b4219f7d3",
                'title'=>'cashier',
                'created_at'=>DB::raw('CURRENT_TIMESTAMP'),
                'updated_at'=>DB::raw('CURRENT_TIMESTAMP')
            )
        );

        DB::table('job_roles')->insert(
            array(
                "id"=>"d6353dd9-2e4a-4a21-81c4-9a4f16cef20c",
                'title'=>'manager',
                'created_at'=>DB::raw('CURRENT_TIMESTAMP'),
                'updated_at'=>DB::raw('CURRENT_TIMESTAMP')
            )
        );
    }

    public function down(): void
    {
        DB::table('user_roles')->truncate();
        DB::table('job_roles')->truncate();

    }
};
