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
        Schema::create('logs', function(Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('message');
            $table->timestamps();

            $table->uuid('employee_id');
            $table->foreign('employee_id')->references('id')->on('employees');
        });

        Schema::create('reports', function(Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('x_data');
            $table->string('y_data');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('logs', function(Blueprint $table) {
            $table->dropForeign(['employee_id']);
        });

        Schema::dropIfExists('logs');
        Schema::dropIfExists('reports');
    }
};
