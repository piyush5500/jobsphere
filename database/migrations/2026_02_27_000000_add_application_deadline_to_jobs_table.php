<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Add application deadline and is_active fields to jobs table
     */
    public function up(): void
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->datetime('application_deadline')->nullable()->after('job_type');
            $table->boolean('is_active')->default(true)->after('application_deadline');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->dropColumn(['application_deadline', 'is_active']);
        });
    }
};

