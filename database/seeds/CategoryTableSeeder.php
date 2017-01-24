<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('category')->insert([

        	[
        		'id' =>  1,
        		'name' => 'Architecture',
        	],

	[ 'id' => 2, 'name' => 'Art & Culture'],
	[ 'id' => 3, 'name' => 'Biology & Life Sciences',],
	[ 'id' => 4, 'name' => 'Business & Management',],
	[ 'id' => 5, 'name' => 'Chemistry',],
	[ 'id' => 6, 'name' => 'Communication',],
	[ 'id' => 7, 'name' => 'Computer Science',],
	[ 'id' => 8, 'name' => 'Data Analysis & Statistics',],
	[ 'id' => 9, 'name' => 'Design',],
	[ 'id' => 10, 'name' => 'Economics & Finance',],
	[ 'id' => 11, 'name' => 'Education and Teacher',],
	[ 'id' => 12, 'name' => 'Training',],
	[ 'id' => 13, 'name' => 'Electronics',],
	[ 'id' => 14, 'name' => 'Energy & Earth Sciences',],
	[ 'id' => 15, 'name' => 'Engineering',],
	[ 'id' => 16, 'name' => 'Environmental Studies',],
	[ 'id' => 17, 'name' => 'Ethics',],
	[ 'id' => 18, 'name' => 'Food & Neutrition',],
	[ 'id' => 19, 'name' => 'Health & Safety',],
	[ 'id' => 20, 'name' => 'Humanities',],
	[ 'id' => 21, 'name' => 'History',],
	[ 'id' => 22, 'name' => 'Language',],
	[ 'id' => 23, 'name' => 'Law',],
	[ 'id' => 24, 'name' => 'Literature',],
	[ 'id' => 25, 'name' => 'Math',],
	[ 'id' => 26, 'name' => 'Medicine',],
	[ 'id' => 27, 'name' => 'Physics']
        	]);
    }
}
