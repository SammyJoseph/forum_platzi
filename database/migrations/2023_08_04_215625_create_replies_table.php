<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('replies', function (Blueprint $table) {
            $table->id();

            $table->text('body');

            $table->unsignedBigInteger('reply_id')->nullable(); // una respuesta puede tener una respuesta            
            $table->foreign('reply_id')->references('id')->on('replies')->onDelete('set null');
            /* set null para que no se borre la respuesta si se borra la respuesta padre a la que pertenece sino que pasa a ser una respuesta sin padre */

            $table->unsignedBigInteger('thread_id'); // una respuesta pertenece a una pregunta
            $table->foreign('thread_id')->references('id')->on('threads')->onDelete('cascade');

            $table->unsignedBigInteger('user_id'); // una respuesta pertenece a un usuario
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('replies');
    }
};
