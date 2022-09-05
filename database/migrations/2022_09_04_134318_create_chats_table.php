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
        Schema::create('chats', function (Blueprint $table) {
            $table->id();

            $table->foreignId('from_user_id')
                    ->constrained('users')
                    ->references('id')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->foreignId('to_user_id')
                    ->constrained('users')
                    ->references('id')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->foreignId('room_id')
                    ->constrained('rooms')
                    ->references('id')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->text('message');

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
        Schema::dropIfExists('chats');
    }
};