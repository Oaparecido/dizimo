<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tithers', function (Blueprint $table) {
            $table->dropColumn('notes');
            $table->date('birth_date')->nullable()->after('address');
            $table->string('partner_name')->nullable()->after('birth_date');
        });
    }

    public function down(): void
    {
        Schema::table('tithers', function (Blueprint $table) {
            $table->dropColumn(['birth_date', 'partner_name']);
            $table->text('notes')->nullable()->after('address');
        });
    }
};
