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
        Schema::create('cleaner_task_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_id')->nullable()->constrained('tasks')->onDelete('set null');
            $table->foreignId('cleaner_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('site_id')->nullable()->constrained('sites')->onDelete('set null');
            $table->foreignId('attendance_id')->nullable()->constrained('cleaner_attendances')->onDelete('set null');
            $table->timestamp('start_time');
            $table->timestamp('finish_time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cleaner_task_reports');
    }
};
