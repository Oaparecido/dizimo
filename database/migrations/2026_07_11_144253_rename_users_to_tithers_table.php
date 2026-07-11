<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::rename('users', 'tithers');

        Schema::table('tithers', function (Blueprint $table) {
            $table->dropColumn(['password', 'remember_token', 'email_verified_at', 'is_admin']);
            $table->string('phone')->nullable()->after('email');
            $table->text('address')->nullable()->after('phone');
            $table->text('notes')->nullable()->after('address');
        });
    }

    public function down(): void
    {
        Schema::table('tithers', function (Blueprint $table) {
            $table->dropColumn(['phone', 'address', 'notes']);
            $table->string('password')->after('email');
            $table->rememberToken()->after('password');
            $table->timestamp('email_verified_at')->nullable()->after('remember_token');
            $table->boolean('is_admin')->default(false)->after('email_verified_at');
        });

        Schema::rename('tithers', 'users');
    }
};
