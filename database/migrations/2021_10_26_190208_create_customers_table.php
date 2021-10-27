<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function ($table) {
            $table->engine = 'InnoDB';

            $table->bigIncrements('id');
            $table->string('name', 255);
            $table->string('email', 255)->unique('email');
            $table->string('phone', 15)->nullable();
            $table->string('city', 15)->nullable();
            $table->string('state', 15)->nullable();
            $table->date('birthday', 15)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
