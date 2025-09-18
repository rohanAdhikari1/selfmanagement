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
        Schema::table('inspectionreports', function (Blueprint $table) {
            $table->longText('inspector_signature')->nullable()->after('is_draft');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inspectionreports', function (Blueprint $table) {
            $table->dropColumn('inspector_signature');
        });
    }
};
