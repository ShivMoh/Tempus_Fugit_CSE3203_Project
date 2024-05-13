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
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamps();
        });

        Schema::create('user_roles', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('type')->unique();
            $table->timestamps();
        });

        Schema::create('employees', function(Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('first_name');
            $table->string('last_name');
            $table->date('dob');
            $table->timestamps();

        });

        Schema::create('addresses', function(Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('line_1');
            $table->string('line_2')->nullable();
            $table->string('city');
            $table->string('state')->nullable();
            $table->string('country');
            $table->boolean('company_address');
            $table->timestamps();

        });


        Schema::create('contacts', function(Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('primary_number');
            $table->string('secondary_number')->nullable();
            $table->string('email');
            $table->timestamps();

        });

        
        Schema::create('job_roles', function(Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->timestamps();

        });        
        
        Schema::create('order_items', function(Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('amount');
            $table->timestamps();
        });      

        Schema::create('items', function(Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->float('selling_price');
            $table->float('cost_price');
            $table->integer('total_sold');
            $table->integer('stock_count');
            $table->string('image_url')->nullable();
            $table->timestamps();

        });
        
        Schema::create('payments', function(Blueprint $table) {
            $table->uuid('id')->primary();
            $table->boolean('cash');            
            $table->float('amount');
            $table->timestamps();
        });

        Schema::create('card_payments', function(Blueprint $table) {
            $table->uuid('id')->primary();
            $table->timestamps();
        });

        Schema::create('cards', function(Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('card_holder');
            $table->string('card_number');
            $table->string('security_pin');
            $table->date('expirary_date');
            $table->boolean('company_card');
            $table->timestamps();
        });

        Schema::create('suppliers', function(Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string("description");
            $table->string('name');
            $table->string("image_url")->nullable();
            $table->timestamps();

        });

        
        Schema::create('categories', function(Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->timestamps();

        });

        
        Schema::create('transactions', function(Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('count');
            $table->float('total_cost');
            $table->timestamps();
        });

        Schema::create('orders', function(Blueprint $table) {
            $table->uuid('id')->primary();
            $table->float('gross_cost');
            $table->float('net_cost');
            $table->float('duty_and_vat');
            $table->float('insurance_fee');
            $table->float('processing_fee');
            $table->float('shipping_fee');
            $table->date('order_date');
            $table->date('date_arrived');
            $table->boolean('received');
            $table->timestamps();

        });

        Schema::create('bills', function(Blueprint $table) {
            $table->uuid('id')->primary();
            $table->float('gross_cost');
            $table->float('net_cost');
            $table->float('discount');
            $table->float('duty_and_vat');
            $table->float('delivery_free')->nullable();
            $table->timestamps();

        });


        Schema::create('deliveries', function(Blueprint $table) {
            $table->uuid('id')->primary();
            $table->date('date_shipped');
            $table->timestamps();

        });

        Schema::create('customers', function(Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('first_name');
            $table->string('last_name');
            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('user_roles');
        Schema::dropIfExists('employees');
        Schema::dropIfExists('addresses');
        Schema::dropIfExists('contacts');
        Schema::dropIfExists('job_roles');
        Schema::dropIfExists('items');
        Schema::dropIfExists('suppliers');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('transactions');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('bills');
        Schema::dropIfExists('deliveries');
        Schema::dropIfExists('customers');
        Schema::dropIfExists('payments');
        Schema::dropIfExists('cards');
        Schema::dropIfExists('card_payments');

    }
};
