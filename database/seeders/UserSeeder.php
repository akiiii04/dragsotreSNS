<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
                'name' => '山本大晃',
                'email' => 'hiroaki200204@gamil.com',
                'password' => Hash::make('TestUser909'),
                'employee_number' => '000000',
                'affiliation' => 'A店',
                'position' => 'パートナー',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ]);
         DB::table('users')->insert([
                'name' => 'テストユーザー',
                'email' => NULL,
                'password' => Hash::make('TestUser909'),
                'employee_number' => '111111',
                'affiliation' => 'A店',
                'position' => 'パートナー',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ]);
    }
}
