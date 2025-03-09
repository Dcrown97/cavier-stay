<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('property_id');
            $table->string('full_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->decimal('amount', 15, 2)->nullable()->default(0.0);
            $table->decimal("charge", 15, 2)->nullable()->default(0.0);
            $table->decimal("total", 15, 2)->nullable()->default(0.0);
            $table->string('trans_ref')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('status')->nullable()->comment("Pending, Success, Failed");
            $table->dateTime("paid_at")->nullable();
            $table->dateTime("initialized_at")->nullable();
            $table->foreign('property_id')->references('id')->on('properties')->onDelete('cascade');
            $table->timestamps();
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
        Schema::dropIfExists('transactions');
    }
}
