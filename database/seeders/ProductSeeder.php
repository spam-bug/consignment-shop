<?php

namespace Database\Seeders;

use App\Enums\ProductStatus;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        foreach ($this->data() as $data) {
            $product = Product::create($data[0]);

            $product->stockRecords()->create($data[1]);
        }
    }

    public function data(): array
    {
        return [
            [
                [
                    'consignor_id' => 1,
                    'category_id' => rand(1, 5),
                    'sku' => 'HAEG',
                    'name' => 'Harmony Elite Acoustic Electric Guitar',
                    'description' => "The Harmony Elite is a versatile acoustic-electric guitar designed for musicians seeking a perfect balance of style, performance, and affordability. Crafted with a solid spruce top and mahogany back and sides, this guitar delivers a warm and resonant tone that suits a wide range of musical styles. Whether you're performing on stage, recording in the studio, or strumming by the campfire, the Harmony Elite is ready to accompany your musical journey.",
                    'price' => 35000.00,
                    'stock' => 50,
                    'stock_threshold' => 10,
                    'photos' => ["photos\/yHhKPzwThP9BzHXPwnNBss2w5tX75p6wgNORoQVa.png"],
                    'status' => ProductStatus::Listed
                ],
                [
                    'quantity' => 50,
                    'remark' => 'initial stock'
                ]
            ],
            [
                [
                    'consignor_id' => 1,
                    'category_id' => rand(1, 5),
                    'sku' => 'MSTRBK',
                    'name' => 'Master Blaster Electric Guitar',
                    'description' => 'The Master Blaster is a high-performance electric guitar designed to unleash your full sonic potential. Featuring high-output humbucker pickups, a lightning-fast maple neck, and a sleek body design, this guitar is ready to rock any stage.',
                    'price' => 42000.00,
                    'stock' => 35,
                    'stock_threshold' => 7,
                    'photos' => ["photos\/yHhKPzwThP9BzHXPwnNBss2w5tX75p6wgNORoQVa.png"],
                    'status' => ProductStatus::Listed
                ],
                [
                    'quantity' => 35,
                    'remark' => 'initial stock'
                ]
            ],
            [
                [
                    'consignor_id' => 2,
                    'category_id' => rand(1, 5),
                    'sku' => 'RBX500',
                    'name' => 'Rockbeast 500 Bass Guitar',
                    'description' => 'The Rockbeast 500 is a powerful bass guitar that delivers a thundering low-end punch. With its active electronics, versatile tone controls, and comfortable playability, this bass is perfect for laying down the foundation for any musical style.',
                    'price' => 28000.00,
                    'stock' => 20,
                    'stock_threshold' => 5,
                    'photos' => ["photos\/yHhKPzwThP9BzHXPwnNBss2w5tX75p6wgNORoQVa.png"],
                    'status' => ProductStatus::Listed
                ],
                [
                    'quantity' => 20,
                    'remark' => 'initial stock'
                ]
            ],
            [
                [
                    'consignor_id' => 1,
                    'category_id' => rand(1, 5),
                    'sku' => 'C500DR',
                    'name' => 'Concerto 500 Digital Piano',
                    'description' => 'The Concerto 500 is a full-featured digital piano that offers a realistic and expressive piano experience. With its weighted keys, authentic sound samples, and a variety of built-in features, this piano is perfect for both beginners and experienced players.',
                    'price' => 65000.00,
                    'stock' => 15,
                    'stock_threshold' => 3,
                    'photos' => ["photos\/yHhKPzwThP9BzHXPwnNBss2w5tX75p6wgNORoQVa.png"],
                    'status' => ProductStatus::Listed
                ],
                [
                    'quantity' => 15,
                    'remark' => 'initial stock'
                ]
            ],
        ];
    }
}
