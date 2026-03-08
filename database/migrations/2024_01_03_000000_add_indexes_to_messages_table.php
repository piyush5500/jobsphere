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
        Schema::table('messages', function (Blueprint $table) {
            // Add index on sender_id for faster message lookups
            $table->index('sender_id', 'messages_sender_id_index');
            
            // Add index on receiver_id for faster message lookups
            $table->index('receiver_id', 'messages_receiver_id_index');
            
            // Add composite index for efficient BETWEEN queries (chat conversations)
            $table->index(['sender_id', 'receiver_id'], 'messages_sender_receiver_index');
            
            // Add index on read_at for faster unread message queries
            $table->index('read_at', 'messages_read_at_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->dropIndex('messages_sender_id_index');
            $table->dropIndex('messages_receiver_id_index');
            $table->dropIndex('messages_sender_receiver_index');
            $table->dropIndex('messages_read_at_index');
        });
    }
};

