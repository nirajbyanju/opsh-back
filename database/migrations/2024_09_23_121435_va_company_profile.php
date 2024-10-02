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
        Schema::create('va_company_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('category_id');
            $table->string('email')->nullable();
            $table->string('phone_number', 20)->nullable(); 
            $table->string('website')->nullable();
            $table->string('location');
            $table->date('established')->nullable();
            $table->string('team_size')->nullable();
            $table->string('logo')->nullable();
            $table->text('description')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamp('verified_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index('email');
            $table->index('phone_number'); // Index on phone number
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('va_company_profiles'); // Drop the table on rollback
    }
};
