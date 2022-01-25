<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->char('zipcode', 8)->nullable();
            $table->string('number');
            $table->string('address');
            $table->string('neighborhood');
            $table->string('complement')->nullable();
            $table->string('city')->default('GOVERNADOR VALADARES');
            $table->char('state', 2)->default('MG');
            $table->boolean('status')->default(false);
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
