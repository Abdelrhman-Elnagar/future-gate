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
        Schema::create('faculties', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('university_id')->constrained()->onDelete('cascade'); // University Relation
            $table->text('description')->nullable(); // Faculty Description
            $table->text('requirements')->nullable(); // متطلبات الكلية like بطاقة, جند
            $table->integer('duration')->default(4); // Years of Study
            $table->text('requirements')->nullable(); // Admission Requirements
            $table->integer('ranking')->nullable(); // Optional Faculty Ranking
            $table->string('address')->nullable(); // Faculty Location
            $table->string('website')->nullable(); // Website URL
            $table->string('logo')->nullable(); // Faculty Logo
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faculties');
    }
};
