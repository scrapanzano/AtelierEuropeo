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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->foreignId('association_id')->constrained('associations')->onDelete('cascade');
            $table->string('image_path');
            $table->enum('status', ['draft', 'published', 'completed'])->default('draft');
            $table->integer('requested_people')->default(0);
            $table->string('location');
            $table->date('start_date');
            $table->date('end_date');
            $table->date('expire_date');
            $table->text('sum_description');
            $table->text('full_description');
            $table->text('requirements');
            $table->text('travel_conditions');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
