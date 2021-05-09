<?php

namespace Database\Seeders;

use App\Models\Theme;
use Illuminate\Database\Seeder;

class ThemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $themes =[
            ['title'=>'Пушкин. Каким я его представляю?', 'age_group_id' => 1],
            ['title'=>'Моя любимая сказка А.С. Пушкина', 'age_group_id' => 1],
            ['title'=>'Сказка – ложь, да в ней – намек, добрым молодцам – урок!', 'age_group_id' => 1],
            ['title'=>'Какие нравственные уроки проходят герои в сказках А.С. Пушкина?', 'age_group_id' => 1],
            ['title'=>'Тема дружбы и любви в творчестве А.С. Пушкина', 'age_group_id' => 2],
            ['title'=>'Мир русской усадьбы. По произведениям А.С. Пушкина', 'age_group_id' => 2],
            ['title'=>'Тема борьбы добра и зла в произведениях А.С. Пушкина', 'age_group_id' => 2],
            ['title'=>'Есть ценности, которым нет цены… М. Борисова (по произведениям А.С. Пушкина)', 'age_group_id' => 3],
            ['title'=>'Великий гуманизм в творчестве А.С. Пушкина', 'age_group_id' => 3],
            ['title'=>'Тяжкое бремя пророка – уметь людям правду сказать… А. Анищенко-Шелехметский (по произведениям А.С. Пушкина)', 'age_group_id' => 3],
            ['title'=>'Как отражается проблема личности в произведениях А.С. Пушкина', 'age_group_id' => 3],
            ['title'=>'Есть ценности, которым нет цены… М. Борисова (по произведениям А.С. Пушкина)', 'age_group_id' => 4],
            ['title'=>'Великий гуманизм в творчестве А.С. Пушкина', 'age_group_id' => 4],
            ['title'=>'Тяжкое бремя пророка – уметь людям правду сказать… А. Анищенко-Шелехметский (по произведениям А.С. Пушкина)', 'age_group_id' => 4],
            ['title'=>'Как отражается проблема личности в произведениях А.С. Пушкина', 'age_group_id' => 4],
        ];

        foreach ($themes as $theme) {
            Theme::create($theme);
        }
    }
}
