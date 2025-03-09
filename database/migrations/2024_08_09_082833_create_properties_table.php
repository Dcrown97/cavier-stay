<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('property_type_id');
            $table->unsignedBigInteger('location_id');
            $table->unsignedBigInteger('sale_type_id');
            $table->string('name')->nullable();
            $table->string('sale_type')->nullable();
            $table->decimal('price', 20, 2)->default(00.00);
            $table->string('address')->nullable();
            $table->string('square_footage')->nullable();
            $table->string('bed')->nullable();
            $table->string('bath')->nullable();
            $table->mediumText('image')->nullable();
            $table->string('is_active')->default(true)->comment(true, false);
            $table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade');
            $table->foreign('property_type_id')->references('id')->on('property_types')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('properties');
    }
}
