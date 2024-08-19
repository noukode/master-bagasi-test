<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::insert([
            [
                'name' => 'LAPTOP HP 14 g102au',
                'desc' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit, eum praesentium expedita necessitatibus quasi asperiores dolorum! Expedita dolorum sint alias harum tempora aspernatur velit eveniet. Voluptatibus ut omnis maxime nam, tenetur similique accusamus illo dolores porro blanditiis corrupti, fuga reprehenderit officiis, a aspernatur incidunt explicabo quisquam quos? Cumque in, libero delectus qui distinctio nisi fugit pariatur neque, saepe sint at, veniam consequuntur corrupti adipisci maiores eveniet necessitatibus! Nam perspiciatis unde quia laborum minus iusto quis laudantium ducimus mollitia! Soluta non impedit adipisci, beatae culpa eligendi sunt, hic laborum pariatur iusto, nihil totam. Provident odio, veritatis aperiam necessitatibus voluptatum esse at!',
                'price' => 10_000_000,
                'is_published' => 1,
                'image' => 'blank.jpg',
                'stock' => 20,
            ],
            [
                'name' => 'LAPTOP ASUS 14 g102au',
                'desc' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit, eum praesentium expedita necessitatibus quasi asperiores dolorum! Expedita dolorum sint alias harum tempora aspernatur velit eveniet. Voluptatibus ut omnis maxime nam, tenetur similique accusamus illo dolores porro blanditiis corrupti, fuga reprehenderit officiis, a aspernatur incidunt explicabo quisquam quos? Cumque in, libero delectus qui distinctio nisi fugit pariatur neque, saepe sint at, veniam consequuntur corrupti adipisci maiores eveniet necessitatibus! Nam perspiciatis unde quia laborum minus iusto quis laudantium ducimus mollitia! Soluta non impedit adipisci, beatae culpa eligendi sunt, hic laborum pariatur iusto, nihil totam. Provident odio, veritatis aperiam necessitatibus voluptatum esse at!',
                'price' => 8_000_000,
                'is_published' => 1,
                'image' => 'blank.jpg',
                'stock' => 20,
            ],
            [
                'name' => 'MACBOOK PRO M1',
                'desc' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit, eum praesentium expedita necessitatibus quasi asperiores dolorum! Expedita dolorum sint alias harum tempora aspernatur velit eveniet. Voluptatibus ut omnis maxime nam, tenetur similique accusamus illo dolores porro blanditiis corrupti, fuga reprehenderit officiis, a aspernatur incidunt explicabo quisquam quos? Cumque in, libero delectus qui distinctio nisi fugit pariatur neque, saepe sint at, veniam consequuntur corrupti adipisci maiores eveniet necessitatibus! Nam perspiciatis unde quia laborum minus iusto quis laudantium ducimus mollitia! Soluta non impedit adipisci, beatae culpa eligendi sunt, hic laborum pariatur iusto, nihil totam. Provident odio, veritatis aperiam necessitatibus voluptatum esse at!',
                'price' => 22_000_000,
                'is_published' => 1,
                'image' => 'blank.jpg',
                'stock' => 20,
            ],
            [
                'name' => 'SAMSUNG GALAXY S23 5G',
                'desc' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit, eum praesentium expedita necessitatibus quasi asperiores dolorum! Expedita dolorum sint alias harum tempora aspernatur velit eveniet. Voluptatibus ut omnis maxime nam, tenetur similique accusamus illo dolores porro blanditiis corrupti, fuga reprehenderit officiis, a aspernatur incidunt explicabo quisquam quos? Cumque in, libero delectus qui distinctio nisi fugit pariatur neque, saepe sint at, veniam consequuntur corrupti adipisci maiores eveniet necessitatibus! Nam perspiciatis unde quia laborum minus iusto quis laudantium ducimus mollitia! Soluta non impedit adipisci, beatae culpa eligendi sunt, hic laborum pariatur iusto, nihil totam. Provident odio, veritatis aperiam necessitatibus voluptatum esse at!',
                'price' => 13_000_000,
                'is_published' => 1,
                'image' => 'blank.jpg',
                'stock' => 20,
            ],
            [
                'name' => 'iPhone 15 Pro Max 256 GB',
                'desc' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit, eum praesentium expedita necessitatibus quasi asperiores dolorum! Expedita dolorum sint alias harum tempora aspernatur velit eveniet. Voluptatibus ut omnis maxime nam, tenetur similique accusamus illo dolores porro blanditiis corrupti, fuga reprehenderit officiis, a aspernatur incidunt explicabo quisquam quos? Cumque in, libero delectus qui distinctio nisi fugit pariatur neque, saepe sint at, veniam consequuntur corrupti adipisci maiores eveniet necessitatibus! Nam perspiciatis unde quia laborum minus iusto quis laudantium ducimus mollitia! Soluta non impedit adipisci, beatae culpa eligendi sunt, hic laborum pariatur iusto, nihil totam. Provident odio, veritatis aperiam necessitatibus voluptatum esse at!',
                'price' => 16_000_000,
                'is_published' => 1,
                'image' => 'blank.jpg',
                'stock' => 20,
            ],
            [
                'name' => 'Nothing Phone 1 128 GB',
                'desc' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit, eum praesentium expedita necessitatibus quasi asperiores dolorum! Expedita dolorum sint alias harum tempora aspernatur velit eveniet. Voluptatibus ut omnis maxime nam, tenetur similique accusamus illo dolores porro blanditiis corrupti, fuga reprehenderit officiis, a aspernatur incidunt explicabo quisquam quos? Cumque in, libero delectus qui distinctio nisi fugit pariatur neque, saepe sint at, veniam consequuntur corrupti adipisci maiores eveniet necessitatibus! Nam perspiciatis unde quia laborum minus iusto quis laudantium ducimus mollitia! Soluta non impedit adipisci, beatae culpa eligendi sunt, hic laborum pariatur iusto, nihil totam. Provident odio, veritatis aperiam necessitatibus voluptatum esse at!',
                'price' => 11_000_000,
                'is_published' => 1,
                'image' => 'blank.jpg',
                'stock' => 20,
            ],
        ]);
    }
}
