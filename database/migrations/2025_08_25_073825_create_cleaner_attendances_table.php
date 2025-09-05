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
            $table->string('entry_longitude')->nullable();
            $table->string('entry_latitude')->nullable();
            $table->string('exit_longitude')->nullable();
            $table->string('exit_latitude')->nullable();
            $table->text('remarks')->nullable();
            $table->string('entry_image_path')->nullable();
            $table->string('exit_image_path')->nullable();
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
