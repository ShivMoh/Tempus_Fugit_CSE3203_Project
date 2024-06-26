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
        Schema::table('users', function(Blueprint $table ) {
            $table->uuid('user_role_id');  
            $table->uuid('employee_id');

            $table->foreign('user_role_id')->references('id')->on('user_roles');
            $table->foreign('employee_id')->references('id')->on('employees');
        });

        Schema::table('employees', function(Blueprint $table ) {
            $table->uuid('job_role_id');
            $table->uuid('contact_id');
            $table->uuid('address_id');
            
            $table->foreign('job_role_id')->references('id')->on('job_roles');
            $table->foreign('contact_id')->references('id')->on('contacts');
            $table->foreign('address_id')->references('id')->on('addresses');
        });
        
        Schema::table('items', function(Blueprint $table ) {
            $table->uuid('category_id');
            $table->uuid('supplier_id');

            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('supplier_id')->references('id')->on('suppliers');
        });

        Schema::table('transactions', function(Blueprint $table ) {
            $table->uuid('item_id');
            $table->uuid('bill_id');

            $table->foreign('item_id')->references('id')->on('items');
            $table->foreign('bill_id')->references('id')->on('bills');
        });
        
        
        Schema::table('bills', function(Blueprint $table ) {
            $table->uuid('user_id');
            $table->uuid('customer_id');
            $table->uuid('payment_id');

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('payment_id')->references('id')->on('payments');
        });
        
        Schema::table('orders', function(Blueprint $table ) {
            $table->uuid('user_id');
            $table->uuid('supplier_id');
            $table->uuid('payment_id');
            $table->uuid('address_id');
            
            $table->foreign('payment_id')->references('id')->on('payments');
            $table->foreign('address_id')->references('id')->on('addresses');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('supplier_id')->references('id')->on('suppliers');            
        });

        Schema::table('order_items', function(Blueprint $table ) {
            $table->uuid('item_id');
            $table->uuid('order_id');
        
            $table->foreign('item_id')->references('id')->on('items');
            $table->foreign('order_id')->references('id')->on('orders');            
        });

        Schema::table('suppliers', function(Blueprint $table ) {
            $table->uuid('contact_id');
            $table->foreign('contact_id')->references('id')->on('contacts');            
        });
        

        Schema::table('card_payments', function(Blueprint $table ) {
            $table->uuid('payment_id');
            $table->uuid('card_id');
            $table->foreign('payment_id')->references('id')->on('payments');            
            $table->foreign('card_id')->references('id')->on('cards');            
        });

        Schema::table('deliveries', function(Blueprint $table ) {
            $table->uuid('bill_id');
            $table->uuid('address_id');
            $table->uuid('contact_id');

            $table->foreign('bill_id')->references('id')->on('bills');
            $table->foreign('address_id')->references('id')->on('addresses');
            $table->foreign('contact_id')->references('id')->on('contacts');
        });

        Schema::table('customers', function(Blueprint $table ) {           
            $table->uuid('contact_id');
            $table->uuid('payment_id');

            $table->foreign('contact_id')->references('id')->on('contacts');
            $table->foreign('payment_id')->references('id')->on('payments');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function(Blueprint $table ) {
            $table->dropForeign(['user_role_id']);
            $table->dropForeign(['employee_id']);

        });

        Schema::table('employees', function(Blueprint $table ) {
            $table->dropForeign(['job_role_id']);
            $table->dropForeign(['contact_id']);
            $table->dropForeign(['address_id']);
        });
        
        Schema::table('items', function(Blueprint $table ) {
            $table->dropForeign(['category_id']);
            $table->dropForeign(['supplier_id']);
        });

        Schema::table('transactions', function(Blueprint $table ) {
            $table->dropForeign(['item_id']);
            $table->dropForeign(['bill_id']);
        });
        
        
        Schema::table('bills', function(Blueprint $table ) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['customer_id']);
            $table->dropForeign(['payment_id']);
        });
        
        Schema::table('orders', function(Blueprint $table ) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['supplier_id']);
            $table->dropForeign(['payment_id']);
            $table->dropForeign(['address_id']);

        });

        Schema::table('order_items', function(Blueprint $table ) {
            $table->dropForeign(['item_id']);
            $table->dropForeign(['order_id']);
        });


        Schema::table('suppliers', function(Blueprint $table ) {
            $table->dropForeign(['contact_id']);
        });
        
        Schema::table('card_payments', function(Blueprint $table ) {
            $table->dropForeign(['payment_id']);
            $table->dropForeign(['card_id']);
        });

        Schema::table('deliveries', function(Blueprint $table ) {
            $table->dropForeign(['bill_id']);
            $table->dropForeign(['address_id']);
            $table->dropForeign(['contact_id']);
        });

        Schema::table('customers', function(Blueprint $table ) {           
            $table->dropForeign(['contact_id']);
            $table->dropForeign(['payment_id']);
        });
    }
};
