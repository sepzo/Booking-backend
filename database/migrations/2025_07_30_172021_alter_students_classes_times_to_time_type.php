<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('students_classes', function (Blueprint $table) {
            $table->time('start_time')->change();
            $table->time('end_time')->change();
        });
    }

    public function down()
    {
        Schema::table('students_classes', function (Blueprint $table) {
            $table->dateTime('start_time')->change();
            $table->dateTime('end_time')->change();
        });
    }
};
