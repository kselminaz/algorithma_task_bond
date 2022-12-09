<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBondsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bonds', function (Blueprint $table) {
            $table->id();
            $table->date('issue_date');
            $table->date('last_circulation_date');
            $table->unsignedInteger('nominal_price');
            $table->enum('coupon_payout_frequency', [1,2,4,12]);
            $table->enum('interest_calculation_period',[360,364,365]);
            $table->unsignedTinyInteger('coupon_interest')->comment('values from [0-100]');

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
        Schema::dropIfExists('bonds');
    }
}
