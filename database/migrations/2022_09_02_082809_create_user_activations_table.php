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
        Schema::create('user_activations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                    ->constrained('users')
                    ->references('id')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->string('token')->nullable();

            $table->timestamps();
        });


        Schema::table('users', function (Blueprint $table) {

            $table->boolean('is_email_verified')->after('mobile')->default(0);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_activations');

        Schema::table('users', function (Blueprint $table) {

                $table->dropColumn('is_activated');

        });

    }
};