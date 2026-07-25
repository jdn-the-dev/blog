<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('giveaway_campaigns', function (Blueprint $table) {
            $table->timestamp('starts_at')->nullable()->after('download_url');
        });

        DB::table('giveaway_campaigns')
            ->whereNull('starts_at')
            ->update(['starts_at' => DB::raw('created_at')]);
    }

    public function down(): void
    {
        Schema::table('giveaway_campaigns', function (Blueprint $table) {
            $table->dropColumn('starts_at');
        });
    }
};
