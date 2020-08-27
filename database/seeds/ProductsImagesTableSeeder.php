<?php

use Illuminate\Database\Seeder;

class ProductsImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_images')->truncate();
        $productImagesRecords = [
            [
                'id' => 1, 'product_id' => 1, 'image' => 'images.jpg-14353.jpg', 'status' => 1
            ],
            [
                'id' => 2, 'product_id' => 1, 'image' => 'Capture001.png-83591.png', 'status' => 1
            ],
            [
                'id' => 3, 'product_id' => 1, 'image' => 'no-image.png', 'status' => 1
            ],
        ];

        DB::table('product_images')->insert($productImagesRecords);
    }
}
