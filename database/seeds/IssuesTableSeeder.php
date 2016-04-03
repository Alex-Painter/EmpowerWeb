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
                        'picture' => ("1.png"),
                        'state' => ('New')
                      ));

      Issue::create(array(
                        'name' => 'Steven Naimar',
                        'picture' => ("2.png"),
                        'state' => ('New')
                      ));

     Issue::create(array(
                        'name' => 'Dele Alli',
                        'picture' => ("3.png"),
                        'state' => ('New')
                      ));
    Issue::create(array(
                        'name' => 'Jermain Defoe',
                        'picture' => ("1.png"),
                        'state' => ('New')
                      ));
    }
}
