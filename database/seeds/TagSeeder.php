<?php

use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tags')->insert([
            'name' => 'HTML'
        ]);
        DB::table('tags')->insert([
            'name' => 'CSS'
        ]);
		DB::table('tags')->insert([
            'name' => 'JS'
        ]);
		DB::table('tags')->insert([
            'name' => 'Node.js'
        ]);
		DB::table('tags')->insert([
            'name' => 'React'
        ]);
		DB::table('tags')->insert([
            'name' => 'Angular.js'
        ]);
		DB::table('tags')->insert([
            'name' => 'PHP'
        ]);
		DB::table('tags')->insert([
            'name' => 'Laravel'
        ]);
    }
}
