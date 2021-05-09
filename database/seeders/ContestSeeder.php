<?php

namespace Database\Seeders;

use App\Models\Contest;
use Illuminate\Database\Seeder;

class ContestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $contests =[
            ['title'=>'Конкурс сочинений по сказкам и другим произведениям А.С. Пушкина'],
            ['title'=>'Конкурс чтецов произведений А.С. Пушкина', 'has_video' => 1],
            ['title'=>'Конкурс театрализованных миниатюр по сказкам А.С. Пушкина', 'has_video' => 1, 'has_multiple_contestants' => 1],
            ['title'=>'Конкурс художественного творчества (графика)'],
            ['title'=>'Конкурс видеороликов', 'has_video' => 1, 'has_multiple_contestants' => 1],
        ];

        foreach ($contests as $contest) {
            Contest::create($contest);
        }
    }
}
