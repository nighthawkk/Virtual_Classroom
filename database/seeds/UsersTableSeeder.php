<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
        	[
        		'id' => 1,
        		'name' => 'Aman kumar',
        		'email' => 'akadpunk@gmail.com',
        		'password' => bcrypt('123456'),
        		'role_id' => 2

        	],
        	[
        		'id' => 2,
        		'name' => 'Md Jalaluddin Ahmed',
        		'email' => 'jalal@yahoo.com',
        		'password' => bcrypt('123456'),
        		'role_id' => 2
        	],
        	[
        		'id' => 3,
        		'name' => 'Haripodo Sutradhar',
        		'email' => 'haripodo@outlook.com',
        		'password' => bcrypt('123456'),
        		'role_id' => 2
        	],
        	[
        		'id' => 4,
        		'name' => 'Atika Farhana',
        		'email' => 'atika@gmail.com',
        		'password' => bcrypt('123456'),
        		'role_id' => 1
        	],
        	[
        		'id' => 5,
        		'name' => 'Anayet Kabir Piyeash',
        		'email' => 'piyeash@fiverr.com',
        		'password' => bcrypt('123456'),
        		'role_id' => 1
        	],
        	[
        		'id' => 6,
        		'name' => 'Md Nahid Chowdhury',
        		'email' => 'nahid@fiverr.com',
        		'password' => bcrypt('123456'),
        		'role_id' => 1
        	],
        	[
        		'id' => 7,
        		'name' => 'Tanvir Towhid',
        		'email' => 'tanvir@gmail.com',
        		'password' => bcrypt('123456'),
        		'role_id' => 1
        	]
        	]);

    }
}
