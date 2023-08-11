<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
                'name' => 'お客様質問',
         ]);
         
        DB::table('tags')->insert([
                'name' => 'ポイントカード',
         ]);
         
        DB::table('tags')->insert([
                'name' => 'ヘルスケア',
         ]);
         
        DB::table('tags')->insert([
                'name' => 'ホーム',
         ]);
         
        DB::table('tags')->insert([
                'name' => 'ビューティー',
         ]);
         
        DB::table('tags')->insert([
                'name' => 'フーズ',
         ]);
         
        DB::table('tags')->insert([
                'name' => 'レジ',
         ]);
    }
}
