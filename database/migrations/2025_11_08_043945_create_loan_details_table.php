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
        Schema::create('loan_details', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('loan_id');
            $table->uuid('book_id');
            $table->integer('jumlah')->default(1);
            $table->timestamps();

            $table->foreign('loan_id')->references('id')->on('loans')->cascadeOnDelete();
            $table->foreign('book_id')->references('id')->on('books')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_details');
    }
};
