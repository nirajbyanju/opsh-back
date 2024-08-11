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
      Schema::create('notifications', function (Blueprint $table) {
    $table->id('notification_id'); // Ensure this matches the reference
    $table->text('message');
    $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
    $table->timestamps(); // Include both created_at and updated_at
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
