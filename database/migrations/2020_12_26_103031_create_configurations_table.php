<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateConfigurationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configurations', function (Blueprint $table) {
            $table->string('key');
            $table->string('value');
            $table->string('description');
            $table->timestamps();
        });

        DB::table('configurations')->insert([
            [
                'key' => 'CONFIG_ENABLE_PAGINATION',
                'value' => '0',
                'description' => 'Enables the pagination',
                'created_at' => now()
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
        Schema::dropIfExists('configurations');
    }
}
