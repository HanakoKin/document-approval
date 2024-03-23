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
        Schema::create('document_approvals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('doc_id');
            $table->unsignedBigInteger('approver_id');
            $table->string('approvers_queue');
            $table->string('approval_status');
            $table->timestamp('approval_date')->nullable();
            $table->timestamps();

            $table->foreign('doc_id')->references('id')->on('documents')->onDelete('cascade');
            $table->foreign('approver_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('document_approvals');
    }
};
