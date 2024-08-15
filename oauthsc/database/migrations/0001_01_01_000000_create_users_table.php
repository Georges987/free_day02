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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();

            $table->text('github_token')->nullable();
            $table->text('github_id')->nullable();
            $table->text('github_refresh_token')->nullable();

            $table->text('google_token')->nullable();
            $table->text('google_id')->nullable();
            $table->text('google_refresh_token')->nullable();

            $table->text('facebook_token')->nullable();
            $table->text('facebook_id')->nullable();
            $table->text('facebook_refresh_token')->nullable();

            $table->text('linkedin_token')->nullable();
            $table->text('linkedin_id')->nullable();
            $table->text('linkedin_refresh_token')->nullable();

            $table->text('microsoft_token')->nullable();
            $table->text('microsoft_id')->nullable();
            $table->text('microsoft_refresh_token')->nullable();

            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
