<?php

use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('issue_statuses')->insert([
        	['name' => 'Archived'],
        	['name' => 'Active'],
        	['name' => 'Solved']
        ]);
    }
}
