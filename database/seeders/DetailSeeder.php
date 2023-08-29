<?php

namespace Database\Seeders;

use App\Models\Detail;
use Illuminate\Database\Seeder;

class DetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $areas = [
            "東京",
            "大阪",
            "福岡"
        ];

        $genres = [
            "寿司",
            "焼肉",
            "居酒屋",
            "イタリアン",
            "ラーメン"
        ];

        $restaurants = [
            [
                'restaurant_id' => 1,
                'area' => $areas[0],
                'genre' => $genres[0]
            ],
            [
                'restaurant_id' => 2,
                'area' => $areas[1],
                'genre' => $genres[1]
            ],
            [
                'restaurant_id' => 3,
                'area' => $areas[2],
                'genre' => $genres[2]
            ],
            [
                'restaurant_id' => 4,
                'area' => $areas[0],
                'genre' => $genres[3]
            ],
            [
                'restaurant_id' => 5,
                'area' => $areas[2],
                'genre' => $genres[4]
            ],
            [
                'restaurant_id' => 6,
                'area' => $areas[0],
                'genre' => $genres[1]
            ],
            [
                'restaurant_id' => 7,
                'area' => $areas[1],
                'genre' => $genres[3]
            ],
            [
                'restaurant_id' => 8,
                'area' => $areas[0],
                'genre' => $genres[4]
            ],
            [
                'restaurant_id' => 9,
                'area' => $areas[1],
                'genre' => $genres[2]
            ],
            [
                'restaurant_id' => 10,
                'area' => $areas[0],
                'genre' => $genres[0]
            ],
            [
                'restaurant_id' => 11,
                'area' => $areas[1],
                'genre' => $genres[1]
            ],
            [
                'restaurant_id' => 12,
                'area' => $areas[2],
                'genre' => $genres[1]
            ],
            [
                'restaurant_id' => 13,
                'area' => $areas[0],
                'genre' => $genres[2]
            ],
            [
                'restaurant_id' => 14,
                'area' => $areas[1],
                'genre' => $genres[0]
            ],
            [
                'restaurant_id' => 15,
                'area' => $areas[0],
                'genre' => $genres[4]
            ],
            [
                'restaurant_id' => 16,
                'area' => $areas[1],
                'genre' => $genres[2]
            ],
            [
                'restaurant_id' => 17,
                'area' => $areas[0],
                'genre' => $genres[0]
            ],
            [
                'restaurant_id' => 18,
                'area' => $areas[0],
                'genre' => $genres[1]
            ],
            [
                'restaurant_id' => 19,
                'area' => $areas[2],
                'genre' => $genres[3]
            ],
            [
                'restaurant_id' => 20,
                'area' => $areas[1],
                'genre' => $genres[0]
            ]
        ];
        
        foreach($restaurants as $restaurant) {
            Detail::create($restaurant);
        }
    }
}
