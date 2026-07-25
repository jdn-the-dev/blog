<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('giveaway_campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('headline', 160);
            $table->text('description');
            $table->decimal('prize_amount', 10, 2);
            $table->text('download_url')->nullable();
            $table->timestamp('ends_at');
            $table->unsignedTinyInteger('minimum_age')->default(18);
            $table->string('eligible_region', 120)->default('Worldwide, where legally permitted');
            $table->boolean('is_active')->default(true);
            $table->text('winner_message')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('giveaway_campaigns');
    }
};
