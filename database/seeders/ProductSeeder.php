<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Define an array of product data
        $products = [
            [
                'name' => 'Product 1',
                'detail' => 'Description of Product 1',
                'price' => "1.00"
            ],
            [
                'name' => 'Product 2',
                'detail' => 'Description of Product 2',
                'price' => "2.00"
            ],
            [
                'name' => 'Product 3',
                'detail' => 'Description of Product 3',
                'price' => "3.00"
            ],
            [
                'name' => 'Product 4',
                'detail' => 'Description of Product 4',
                'price' => "4.00"
            ],
            [
                'name' => 'Product 5',
                'detail' => 'Description of Product 5',
                'price' => "5.00"
            ],
            [
                'name' => 'Product 6',
                'detail' => 'Description of Product 6',
                'price' => "6.00"
            ],
            [
                'name' => 'Product 7',
                'detail' => 'Description of Product 7',
                'price' => "7.00"
            ],
            
            // Add more product data as needed
        ];

        // Insert the data into the 'products' table using the Product model
        foreach ($products as $productData) {
            Product::create($productData);
        }
    }
}
