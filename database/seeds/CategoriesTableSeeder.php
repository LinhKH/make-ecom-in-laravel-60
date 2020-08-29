<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->truncate();
        $categoryRecords = [
            ['id' => 1, 'parent_id' => 0, 'section_id' => 1, 'category_name' => 'Tshirts', 'category_image' => '', 'category_discount' => 0, 'description' => '', 'url' => 't-shirts', 'meta_title' => 'tshirts', 'meta_description' => 'tshirts', 'meta_keywords' => 'tshirts', 'status' => 1],
            ['id' => 2, 'parent_id' => 0, 'section_id' => 1, 'category_name' => 'Shirts', 'category_image' => '', 'category_discount' => 0, 'description' => '', 'url' => 'shirts', 'meta_title' => 'shirts', 'meta_description' => 'shirts', 'meta_keywords' => 'shirts', 'status' => 1],
            ['id' => 3, 'parent_id' => 0, 'section_id' => 1, 'category_name' => 'Denims', 'category_image' => '', 'category_discount' => 0, 'description' => '', 'url' => 'denims', 'meta_title' => 'denims', 'meta_description' => 'denims', 'meta_keywords' => 'denims', 'status' => 1],
            ['id' => 4, 'parent_id' => 1, 'section_id' => 1, 'category_name' => 'Casual Tshirts', 'category_image' => '', 'category_discount' => 0, 'description' => '', 'url' => 'casual-tshirts', 'meta_title' => 'casual tshirts', 'meta_description' => 'casual tshirts', 'meta_keywords' => 'casual tshirts', 'status' => 1],
            ['id' => 5, 'parent_id' => 0, 'section_id' => 2, 'category_name' => 'Denims', 'category_image' => '', 'category_discount' => 0, 'description' => '', 'url' => 'denims-women', 'meta_title' => 'denims women', 'meta_description' => 'denims women', 'meta_keywords' => 'denims women', 'status' => 1],
        ];

        // Category::insert($categoryRecords);
        DB::table('categories')->insert($categoryRecords);
    }
}

