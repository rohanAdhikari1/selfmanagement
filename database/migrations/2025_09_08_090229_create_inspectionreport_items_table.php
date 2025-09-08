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
        Schema::create('inspectionreport_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inspectionreport_id')->constrained('inspectionreports')->cascadeOnDelete();
            $table->foreignId('question_id')->nullable()->constrained('inspection_questions')->nullOnDelete();
            $table->foreignId('answer_id')->nullable()->constrained('inspection_answer_options')->nullOnDelete();
            $table->boolean('is_active')->default(true);
            $table->integer('obtained_point')->default(0);
            $table->text('remarks')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inspectionreport_items');
    }
};
