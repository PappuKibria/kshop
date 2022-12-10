<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id');
            $table->integer('subcategory_id');
            $table->string('name');
            $table->double('price');
            $table->double('special_price')->nullable();
            $table->integer('stock')->nullable();
            $table->string('short_description')->nullable();
            $table->text('description')->nullable();
            $table->string('speciality')->nullable();
            $table->string('manufacturer')->nullable();
            $table->string('photo')->nullable();
            $table->string('photo2')->nullable();
            $table->string('photo3')->nullable();
            $table->string('photo4')->nullable();
            $table->string('photo5')->nullable();
            $table->integer('total_rating')->nullable();
            $table->integer('rate_amount')->nullable();
            $table->integer('wish_amount')->nullable();
            $table->tinyInteger('status');
            $table->integer('priority')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
