<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('giveaway_campaigns', function (Blueprint $table) {
            $table->timestamp('closed_at')->nullable()->after('is_active');
        });

        Schema::table('giveaway_entries', function (Blueprint $table) {
            $table->foreignId('campaign_id')
                ->nullable()
                ->after('id')
                ->constrained('giveaway_campaigns')
                ->nullOnDelete();
        });

        $campaignId = DB::table('giveaway_campaigns')->orderByDesc('id')->value('id');
        if ($campaignId) {
            DB::table('giveaway_entries')
                ->whereNull('campaign_id')
                ->update(['campaign_id' => $campaignId]);
        }

        Schema::table('giveaway_entries', function (Blueprint $table) {
            $table->dropUnique('giveaway_entries_email_unique');
            $table->unique(['campaign_id', 'email']);
        });
    }

    public function down(): void
    {
        Schema::table('giveaway_entries', function (Blueprint $table) {
            $table->dropUnique(['campaign_id', 'email']);
            $table->unique('email');
            $table->dropConstrainedForeignId('campaign_id');
        });

        Schema::table('giveaway_campaigns', function (Blueprint $table) {
            $table->dropColumn('closed_at');
        });
    }
};
