<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * This migration was intentionally left empty to avoid conflicts.
     * The jobs table is created in migration: 0001_01_01_000002_create_jobs_table.php
     */
    public function up(): void
    {
        // Jobs table is already created in 0001_01_01_000002_create_jobs_table.php
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No changes needed - jobs table is dropped in 0001_01_01_000002_create_jobs_table.php
    }
};
