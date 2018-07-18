<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collective_settings', function (Blueprint $table) {
            $table->string('key', 150);
            $table->string('value', 150);
            $table->timestamps();
            $table->primary('key');
        });

        Artisan::call('db:seed', [
            '--class' => SettingsTableSeeder::class,
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
