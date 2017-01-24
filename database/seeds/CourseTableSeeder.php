<?php

use Illuminate\Database\Seeder;

class CourseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('courses')->insert([
        	['id' => 1, 'title' => 'Introduction to Python for Data Science', 'category_id' => 7, 'class_number' => 15,'max_allowed_student' => 15, 'user_id' => 2, 'description' => 'Python is a very powerful programming language used for many different applications. Over time, the huge community around this open source language has created quite a few tools to efficiently work with Python. In recent years, a number of tools have been built specifically for data science. As a result, analyzing data with Python has never been easier.

In this practical course, you will start from the very beginning, with basic arithmetic and variables, and learn how to handle data structures, such as Python lists, Numpy arrays, and Pandas DataFrames. Along the way, you’ll learn about Python functions and control flow. Plus, you’ll look at the world of data visualizations with Python and create your own stunning visualizations based on real data.'],
			
			['id' => 2, 'title' => 'Circuits and Electronics 1: Basic Circuit Analysis', 'category_id' => 13, 'class_number' => 12, 'max_allowed_student' => 15, 'user_id' => 1, 'description' => 'Want to learn about circuits and electronics, but unsure where to begin? Wondering how to make computers run faster or your mobile phone battery last longer? This free circuit course taught by edX CEO and MIT Professor Anant Agarwal and colleagues is for you.

This is the first of three online Circuits & Electronics courses offered by Professor Anant Agarwal and colleagues at MIT, and is taken by all MIT Electrical Engineering and Computer Science (EECS) majors.

Topics covered include: resistive elements and networks; circuit analysis methods including KVL, KCL and the node method; independent and dependent sources; linearity, superposition, Thevenin & Norton methods; digital abstraction, combinational gates; and MOSFET switches and small signal analysis. Design and lab exercises are also significant components of the course.

Weekly coursework includes interactive video sequences, readings from the textbook, homework, online laboratories, and optional tutorials. The course will also have a final exam. 

This is a self-paced course, so there are no weekly deadlines. However, all assignments are due by May 16, 2017, when the course will close.'],

			['id' => 3, 'title' => 'Introduction to Algebra', 'category_id' => 25, 'class_number' => 15, 'max_allowed_student' => 15, 'user_id' => 3, 'description' => "We live in a world of numbers. You see them every day: on clocks, in the stock market, in sports, and all over the news. Algebra is all about figuring out the numbers you don't see. You might know how fast you can throw a ball, but can you use this number to determine how far you can throw it? You might keep track of stock prices, but how can you figure out how much money you've made (or lost) in the market? And you may already know how to tell time, but can you calculate at what times a clock's hour and minute hands are exactly aligned? With algebra, you can answer all of these questions, using the numbers you already know to solve for the unknown. Algebra is an essential tool for all of high school and college-level math, science, and engineering. So if you're starting out in one of these fields and you haven't yet mastered algebra, then this is the course for you!
 
In this course, you'll be able to choose your own path within each lesson, and you can jump between lessons to quickly review earlier material. AlgebraX covers a standard curriculum in high school Algebra I, and CCSS (common core) alignment is indicated where applicable."]

        	]);
    }
}
