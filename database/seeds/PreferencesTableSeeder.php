<?php

use Illuminate\Database\Seeder;

class PreferencesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('preferences')->insert([
            'id' => 'sanitize_results',
            'value' => 'true'
        ]);
        DB::table('preferences')->insert([
            'id' => 'max_history_limit',
            'value' => '100'
        ]);
    }
}
