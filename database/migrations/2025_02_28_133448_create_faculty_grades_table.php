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
        Schema::create('faculty_grades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('faculty_id')->constrained()->onDelete('cascade'); // Each grade belongs to a faculty
            $table->enum('study_track', ['علمي علوم', 'علمي رياضة', 'أدبي']); // Study track
            $table->decimal('minimum_grade', 5, 2); // Example: 387.0
            $table->decimal('percentage', 5, 2)->nullable()->storedAs('ROUND((minimum_grade / 410) * 100, 2)');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faculty_grades');
    }
};
