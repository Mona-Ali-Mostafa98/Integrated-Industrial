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
        Schema::create('ads', function (Blueprint $table) {
            $table->id();

            $table->foreignId('category_id')
                    ->constrained('categories')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->foreignId('user_id')
                    ->constrained('users')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->foreignId('region_id')
                    ->constrained('regions')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->foreignId('city_id')
                    ->constrained('cities')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->foreignId('subcategory_id')
                    ->constrained('categories')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->foreignId('model_id')
                    ->constrained('ad_models')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->string('mobile');
            $table->string('price');
            $table->text('description');

            $table->boolean('hide_mobile')->default(false);

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
        Schema::dropIfExists('ads');
    }
};