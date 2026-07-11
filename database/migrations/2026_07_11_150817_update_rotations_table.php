<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('rotations', function (Blueprint $table) {
            $table->dropColumn(['starts_at', 'ends_at']);
            $table->foreignId('community_id')->nullable()->constrained()->nullOnDelete();
            $table->unsignedTinyInteger('day_of_week')->comment('0=Sunday, 1=Monday, ..., 6=Saturday');
            $table->unsignedTinyInteger('week_occurrence')->comment('1st, 2nd, 3rd, 4th, 5th occurrence of the day in the month');
            $table->string('time', 5)->comment('HH:MM format, e.g. 08:00, 19:00');
        });
    }

    public function down(): void
    {
        Schema::table('rotations', function (Blueprint $table) {
            $table->dropColumn(['community_id', 'day_of_week', 'week_occurrence', 'time']);
            $table->dateTime('starts_at');
            $table->dateTime('ends_at');
        });
    }
};
