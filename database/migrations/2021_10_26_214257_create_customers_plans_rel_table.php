<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateCustomersPlansRelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('customers_plans_rel', function (Illuminate\Database\Schema\Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('customer_id')->unsigned();
            $table->foreign('customer_id')
                ->references('id')
                ->on('customers')->onDelete('cascade');

            $table->bigInteger('plan_id')->unsigned();
            $table->foreign('plan_id')
                ->references('id')
                ->on('plans')->onDelete('cascade');

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
        Schema::dropIfExists('customers_plans_rel');
    }
}
