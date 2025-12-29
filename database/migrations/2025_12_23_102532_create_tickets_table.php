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
        // database/migrations/xxxx_create_tickets_table.php
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->foreignId('assigned_to')->nullable()
            ->constrained('users');
            $table->string('title');
            $table->text('description');
            $table->enum('priority', ['low', 'medium', 'high'])->default('medium');
            $table->enum('status', ['open', 'in-progress', 'resolved', 'closed'])->default('open');
            $table->enum('rating', ['excellent', 'good', 'average', 'poor'])->nullable();
            $table->text('feedback_comment')->nullable();
            $table->boolean('is_reopened')->default(false);
            $table->timestamp('reopened_at')->nullable();
            // Images (store as JSON array of file paths)
            $table->json('images')->nullable();
            // Active status (for soft hide/show)
            $table->boolean('is_active')->default(true);
            // Soft deletes
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
