<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('survey_responses', function (Blueprint $table) {
            $table->id();
            $table->enum('experience', ['none', 'beginner', 'intermediate', 'advanced']);
            $table->enum('has_traded', ['yes', 'no']);
            $table->enum('frequency', ['never', 'weekly', 'daily', 'multiple']);
            $table->enum('risk_tolerance', ['low', 'medium', 'high']);
            $table->enum('motivation', ['profit', 'long_term', 'learning', 'diversify', 'other']);
            $table->string('email')->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('survey_responses');
    }
};
