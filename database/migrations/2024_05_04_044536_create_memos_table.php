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
        Schema::create('memos', function (Blueprint $table) {
            $table->id();
            $table->string('no_doc')->unique()->nullable();
            $table->string('subject');
            $table->string('description');
            $table->string('placeNdate')->nullable();
            $table->string('filename');
            $table->text('signature');
            $table->text('document_text')->nullable();
            $table->text('path')->nullable();
            $table->text('lampiran')->nullable();
            $table->unsignedBigInteger('sender_id');
            $table->timestamps();

            $table->foreign('sender_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('memos');
    }
};
