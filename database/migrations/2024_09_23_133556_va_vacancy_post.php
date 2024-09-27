<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('va_vacancy_post', function (Blueprint $table) {
            $table->id();  // Auto-incrementing ID
            $table->string('position'); // Job position
            $table->foreignId('category_id')->constrained('category')->onDelete('cascade'); // Foreign key with constraint
            $table->foreignId('company_id')->constrained('va_company_profiles')->onDelete('cascade'); // Foreign key with constraint
            $table->string('type'); // Job type as a string (Full-time, Part-time, etc.)
            $table->string('level'); // Job level as a string (Entry, Mid, Senior, etc.)
            $table->string('location');
            $table->string('website')->nullable();
            $table->string('email')->nullable();
            $table->string('phone_number', 20)->nullable();
            $table->unsignedTinyInteger('age')->nullable(); // Age, limited to small positive values
            $table->date('deadline'); // Renamed to 'deadline' and used the 'date' type
            $table->decimal('offered_salary', 10, 2)->nullable(); // Salary with decimal precision
            $table->string('tags')->nullable(); // Tags as a string, for multiple tags you can store them as JSON or use a relation
            $table->text('description'); // Job description
            $table->string('photo')->nullable(); // Allow photo to be nullable
            $table->boolean('status')->default(true); // Job status (active/inactive)
            $table->foreignId('verified_by')->nullable()->constrained('users')->nullOnDelete(); // Foreign key for the verifier
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade'); // Foreign key for the creator
            $table->timestamps();
            $table->softDeletes(); // Soft delete functionality
        });
    }

    public function down(): void
{
    Schema::dropIfExists('va_vacancy_post');
}

    
};
