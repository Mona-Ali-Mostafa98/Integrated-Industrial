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
        Schema::create('regions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('country_id')
                    ->constrained('countries')
                    ->references('id')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->foreignId('city_id')
                    ->constrained('cities')
                    ->references('id')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->string('region_name')->unique();

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
        Schema::dropIfExists('regions');
    }
};
