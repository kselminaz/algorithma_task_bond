<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBondOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bond_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bond_id')->constrained('bonds')->onUpdate('cascade')->onDelete('cascade');
            $table->date('order_date');
            $table->unsignedInteger('bond_order_count');

            $table->dateTime('created_at')->useCurrent();
            $table->dateTime('updated_at')->useCurrent();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bond_orders');
    }
}
