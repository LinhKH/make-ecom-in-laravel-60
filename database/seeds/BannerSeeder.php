<?php

use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('banners')->truncate();
        $brandRecords = [
            ['id' => 1, 'image'=>'1.png','link' => '','title' => '','alt' => '','status'=>1],
            ['id' => 2, 'image'=>'2.png','link' => '','title' => '','alt' => '','status'=>1],
            ['id' => 3, 'image'=>'3.png','link' => '','title' => '','alt' => '','status'=>1],
        ];

        DB::table('banners')->insert($brandRecords);
    }
}
