<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('specie_id');
            $table->unsignedBigInteger('breed_id');
            $table->unsignedBigInteger('pelage_id');

            $table->string('name');
            $table->string('name_search');
            $table->enum('sex', ['M', 'F']);
            $table->date('birthday')->nullable();
            $table->boolean('status')->default(1);
            $table->text('notes')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('CASCADE');
            $table->foreign('specie_id')->references('id')->on('species')->onDelete('CASCADE');
            $table->foreign('breed_id')->references('id')->on('breeds')->onDelete('CASCADE');
            $table->foreign('pelage_id')->references('id')->on('pelages')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pets');
    }
}
