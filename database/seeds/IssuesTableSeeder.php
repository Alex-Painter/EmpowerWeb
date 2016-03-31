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

      Issue::create(array(
                        'name' => 'Ross Barkley',
                        'picture' => ("pictures/1.png"),
                        'state' => ('New')
                      ));
      Issue::create(array(
                        'name' => 'Steven Naimar',
                        'picture' => ("pictures/2.png"),
                        'state' => ('New')
                      ));
     Issue::create(array(
                        'name' => 'Dele Alli',
                        'picture' => ("pictures/3.png"),
                        'state' => ('New')
                      ));
    Issue::create(array(
                        'name' => 'Jermain Defoe',
                        'picture' => ("pictures/1.png"),
                        'state' => ('New')
                      ));
    }
}
