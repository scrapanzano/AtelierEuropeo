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
        Schema::create('project', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignId('author_id')->constrained('author')->onDelete('cascade');
            $table->foreignId('category_id')->constrained('category')->onDelete('cascade');
            $table->foreignId('association_id')->constrained('association')->onDelete('cascade');
            $table->integer('requested_people');
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
        Schema::dropIfExists('project');
    }
};
