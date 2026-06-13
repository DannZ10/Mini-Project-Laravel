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
        Schema::create('courses', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->text('description');
            $table->decimal('price', 10, 2)->default(0);
            $table->integer('quota')->default(0);
            $table->decimal('rating', 3, 1)->default(0.0);
            $table->string('thumbnail')->nullable();
            $table->enum('level', ['beginner', 'intermediate', 'advanced']);
            $table->integer('duration')->default(1);
            $table->enum('status', ['draft', 'published'])->default('draft');
            $table->integer('enrolled_count')->default(0);

            $table->foreignUuid('instructor_id')->constrained('users')->cascadeOnDelete();
            $table->foreignUuid('category_id')->constrained('course_categories')->restrictOnDelete();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
