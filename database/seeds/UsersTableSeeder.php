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

      User::create(array(
                        'name' => 'admin',
                        'password' => Hash::make('h0ck3y'),
                        'department' => 'IT'
                      ));
      User::create(array(
		                    'name' => 'Gary',
		                    'password' => Hash::make('c0ff33'),
		                    'department' => 'Kitchen'
					            ));
    }
}
