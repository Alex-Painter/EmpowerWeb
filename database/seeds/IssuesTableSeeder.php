<?php

use Illuminate\Database\Seeder;
use App\Issue;

class IssuesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      DB::table('issues')->delete();

      Issue::create(array());
    }
}
