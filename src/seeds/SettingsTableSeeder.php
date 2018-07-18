<?php

use App\Setting;
use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::unguard();
        $this->data()->each(function ($data) {
            Setting::create($data);
        });
        Setting::reguard();
    }

    /**
     * Supply data for seeding
     *
     * @return collection
     */
    private function data()
    {
        return collect([
            ['key' => 'prefix', 'value' => '']
        ]);
    }

}
