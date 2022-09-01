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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->text('profile_image');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('mobile')->unique();
            $table->string('password');
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
            $table->text('address')->nullable();
            $table->text('address_on_map')->nullable();
            $table->text('details')->nullable();
            $table->enum('status', ['مفعل' , 'غير مفعل'])->default('مفعل');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
