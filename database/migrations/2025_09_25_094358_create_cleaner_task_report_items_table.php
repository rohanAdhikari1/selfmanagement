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
        Schema::create('cleaner_task_report_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('report_id')->constrained('cleaner_task_reports')->onDelete('cascade');
            $table->foreignId('task_id')->nullable()->constrained('tasks')->onDelete('set null');
            $table->timestamp('start_time');
            $table->timestamp('finish_time')->nullable();
            $table->string('start_longitude')->nullable();
            $table->string('start_latitude')->nullable();
            $table->string('finish_longitude')->nullable();
            $table->string('finish_latitude')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cleaner_task_report_items');
    }
};
