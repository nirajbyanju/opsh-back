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
        Schema::create('user_notifications', function (Blueprint $table) {
            $table->id('user_notification_id'); // Primary key
            $table->unsignedBigInteger('user_id'); // No foreign key constraint
            $table->unsignedBigInteger('notification_id'); // No foreign key constraint
            $table->boolean('is_read')->default(false);
            $table->timestamp('read_at')->nullable();
            $table->timestamps(); // created_at and updated_at

            // Indexes for potential query optimization
            $table->index('user_id');
            $table->index('notification_id');
        });
        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_notifications');
    }
};
