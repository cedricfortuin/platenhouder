<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert([
            [
                'name' => 'Cedric Fortuin',
                'email' => 'info@cedricfortuin.com',
                'password' => '$2y$10$DYJOTt0CgoluAtKA6f2t4O9wAzqXizYkPnJ40rgwjjo5KTHAmPn4a',
                'created_at' => now(),
            ],
            [
                'name' => 'Bas Fortuin',
                'email' => 'bas.fortuin@gmail.com',
                'password' => '$2y$10$vmwSqFi9MqGf57kO1RmcCe1TY/Fz26ZoZanUhAZd6onbawa/xWniC',
                'created_at' => now(),
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
