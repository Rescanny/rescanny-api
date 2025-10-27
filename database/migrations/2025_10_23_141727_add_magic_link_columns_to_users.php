<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('magic_link_uuid')
                ->nullable()
                ->default(null)
                ->after('email');

            $table->dateTime('magic_link_expires_at')
                ->nullable()
                ->default(null)
                ->after('magic_link_uuid');

            $table->dropColumn('email_verified_at');
            $table->dropColumn('password');
        });
    }
};
