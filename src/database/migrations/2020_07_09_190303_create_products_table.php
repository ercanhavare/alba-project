<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
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
            $table->string("name");
            $table->unsignedBigInteger("quantity");
            $table->unsignedDecimal("price",10,2);
            $table->text("desc");
            $table->unsignedBigInteger("image_id");
            $table->unsignedBigInteger("category_id");
            $table->unsignedBigInteger("user_id");
            $table->timestamps();
            $table->softDeletes();

            $table->foreign("image_id")->references("id")->on("images")->onDelete("cascade");
            $table->foreign("category_id")->references("id")->on("categories")->onDelete("cascade");
            $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
