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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();

            $table->string('category_name');

            $table->text('category_image');

            $table->unsignedBigInteger('parent_id')->nullable();
            $table->foreign('parent_id')
                    ->references('id')
                    ->on('categories')
                    ->constrained()
                    ->onUpdate('cascade')
                    ->onDelete('cascade')->nullable();

            $table->enum('category_order', ['قسم رئيسى' , 'قسم فرعى','قسم فرعى من قسم فرعى أخر'])->default('قسم رئيسى');

            $table->enum('status', ['عرض' , 'أخفاء'])->default('عرض');

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
        Schema::dropIfExists('categories');
    }
};