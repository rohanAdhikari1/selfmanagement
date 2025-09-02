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
        Schema::create('cleaner_attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cleaner_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('enrollment_id')->nullable()->constrained('user_enrollments')->onDelete('set null');
            $table->timestamp('start_time');
            $table->timestamp('end_time')->nullable();
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cleaner_attendances');
    }
};
