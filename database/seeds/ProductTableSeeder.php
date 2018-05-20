<?php

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $product = new \App\Product([
        'imagePath' => '/css/2205.jpg',
        'title' => 'Cotton Suit',
        'description' => 'Plain Cotton Silk Abaya Style Suit in Lilac',
        'price' => '20'
      ]);
      $product->save();

      $product = new \App\Product([
        'imagePath' => '/css/2205.jpg',
        'title' => 'Lawn Suit',
        'description' => 'Embroidered Net Abaya Style Suit in Lilac',
        'price' => '18'
      ]);
      $product->save();

      $product = new \App\Product([
        'imagePath' => '/css/2205.jpg',
        'title' => 'Saree Suit',
        'description' => 'Embroidered Chiffon Saree in Beige and Black',
        'price' => '25'
      ]);
      $product->save();

      $product = new \App\Product([
        'imagePath' => '/css/2205.jpg',
        'title' => ' Net Lehenga',
        'description' => 'Embroidered Net Lehenga in Navy Blue',
        'price' => '35'
      ]);
      $product->save();

      $product = new \App\Product([
        'imagePath' => '/css/2205.jpg',
        'title' => 'Georgette Suit',
        'description' => 'Embroidered Net Abaya Style Suit in Light Grey',
        'price' => '33'
      ]);
      $product->save();
    }
}
