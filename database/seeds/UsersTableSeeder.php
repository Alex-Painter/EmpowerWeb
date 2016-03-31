<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      DB::table('users')->delete();

      User::create(array(
                        'name' => 'admin',
                        'password' => Hash::make('h0ck3y'),
                        'department' => 'IT'
                      ));
      User::create(array(
                        'name' => 'Adam',
                        'password' => Hash::make('Imogenisacunt'),
                        'department' => 'HR'
                                      ));
User::create(array(
		  'name' => 'Juliette',
		  'password' => Hash::make('ilovemaths'),
		  'department' => 'Kitchen'
					));
    }
}
