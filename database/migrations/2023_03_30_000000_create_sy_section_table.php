<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sy_section', function (Blueprint $table) {
            $table->id();
            $table->integer('sy_id');
            $table->integer('course_id');
            $table->integer('section_id');
            $table->integer('subject_id');
            $table->integer('max_slot_count');
            $table->integer('current_slot_count');
            $table->integer('is_slot_full');
            $table->string('status');
            $table->integer('created_by');
            $table->integer('updated_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sy_section');
    }
};
