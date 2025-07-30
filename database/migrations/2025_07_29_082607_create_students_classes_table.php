<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('students_classes', function (Blueprint $table) {
            $table->id();
            $table->string('class_name');
            $table->timestamp('start_time');
            $table->timestamp('end_time');
            $table->unsignedInteger('capacity');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students_classes');
    }
};
