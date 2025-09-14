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
        Schema::create('inspectionreports', function (Blueprint $table) {
            $table->id();
            $table->string('report_number')->unique();
            $table->string('title')->nullable();
            $table->foreignId('site_id')->constrained('sites')->cascadeOnDelete();
            $table->string('inspection_type')->nullable();
            $table->string('frequency')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_draft')->default(true);
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
        Schema::dropIfExists('inspectionreports');
    }
};
