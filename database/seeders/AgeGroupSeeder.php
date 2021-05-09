<?php

namespace Database\Seeders;

use App\Models\AgeGroup;
use Illuminate\Database\Seeder;

class AgeGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ageGroups =[
            ['title'=>'2 группа: с 1 по 4 класс', 'contest_id' => 1],
            ['title'=>'3 группа: с 5 по 7 класс', 'contest_id' => 1],
            ['title'=>'4 группа: с 8 по 11 класс', 'contest_id' => 1],
            ['title'=>'5 группа: с 1 по 5 курс ССУЗов, ВУЗов', 'contest_id' => 1],
            ['title'=>'1 группа: с 5 до 7 лет (детский сад)', 'contest_id' => 2],
            ['title'=>'2 группа: с 1 по 4 класс', 'contest_id' => 2],
            ['title'=>'3 группа: с 5 по 7 класс', 'contest_id' => 2],
            ['title'=>'4 группа: с 8 по 11 класс', 'contest_id' => 2],
            ['title'=>'5 группа: с 1 по 5 курс ССУЗов, ВУЗов', 'contest_id' => 2],
            ['title'=>'1 группа: с 5 до 7 лет (детский сад)', 'contest_id' => 3],
            ['title'=>'2 группа: с 1 по 4 класс', 'contest_id' => 3],
            ['title'=>'3 группа: с 5 по 7 класс', 'contest_id' => 3],
            ['title'=>'4 группа: с 8 по 11 класс', 'contest_id' => 3],
            ['title'=>'5 группа: с 1 по 5 курс ССУЗов, ВУЗов', 'contest_id' => 3],
            ['title'=>'1 группа: с 5 до 7 лет (детский сад)', 'contest_id' => 4],
            ['title'=>'2 группа: с 1 по 4 класс', 'contest_id' => 4],
            ['title'=>'3 группа: с 5 по 7 класс', 'contest_id' => 4],
            ['title'=>'4 группа: с 8 по 11 класс', 'contest_id' => 4],
            ['title'=>'5 группа: с 1 по 5 курс ССУЗов, ВУЗов', 'contest_id' => 4],
            ['title'=>'3 группа: с 5 по 7 класс', 'contest_id' => 5],
            ['title'=>'4 группа: с 8 по 11 класс', 'contest_id' => 5],
            ['title'=>'5 группа: с 1 по 5 курс ССУЗов, ВУЗов', 'contest_id' => 5],
            ['title'=>'6 группа – от 19 до 23 лет (Профессионалы)', 'contest_id' => 5],
        ];

        foreach ($ageGroups as $ageGroup) {
            AgeGroup::create($ageGroup);
        }
    }
}
