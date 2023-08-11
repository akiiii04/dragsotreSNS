<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user')->insert([
                'name' => '山本大晃',
                'email' => 'hiroaki200204@gamil.com',
                'password' => ' $2y$10$JpsdImNMLdI3ZRsdQHtPY.dMKvy/yAEjtvkolR0tkacns4QvuBfc2',
                'employee_number' => '000000',
                'affiliation' => 'A店',
                'position' => 'パートナー',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ]);//
    }
}
