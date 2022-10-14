<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username', 30);
            $table->string('email', 200);
            $table->string('password', 200);
            $table->string('avatar_url', 200)->default('https://cdn.discordapp.com/embed/avatars/0.png');
            $table->string('remember_token', 100)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamps();
        });

        Schema::create('guilds', function (Blueprint $table) {
            $table->id();
            $table->string('displayname', 30);
            $table->string('avatar_url', 200);
            $table->string('banner_url', 200);
            $table->foreignId('user_id');
            $table->timestamps();
        });

        Schema::create('user_guild', function (Blueprint $table) {
            $table->foreignId('user_id');
            $table->foreignId('guild_id');
            $table->primary(['user_id', 'guild_id']);
        });

        Schema::create('channels', function (Blueprint $table) {
            $table->id();
            $table->string('name', 30);
            $table->string('description', 200);
            $table->foreignId('guild_id');
            $table->timestamps();
        });

        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->string('content', 2000);
            $table->foreignId('channel_id');
            $table->foreignId('message_id');
            $table->foreignId('user_id');
            $table->timestamps();
        });

        Schema::create('reactions', function (Blueprint $table) {
            $table->id();
            $table->string('reaction', 20);
            $table->foreignId('message_id');
            $table->foreignId('user_id');
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
        Schema::dropIfExists('tables');
    }
};
