<?php

namespace Database\Seeders;

use App\Models\ApplicationStatus;
use Illuminate\Database\Seeder;

class ApplicationStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            ['title' => 'В обработке', 'status' => 'in_progress', 'description' => null],
            ['title' => 'Не корректные данные', 'status' => 'in_correct', 'description' => null],
            ['title' => 'Успешно', 'status' => 'success', 'description' => 'Грамота'],
        ];

        foreach ($statuses as $status) {
            ApplicationStatus::updateOrCreate([
                'status' => $status['status'],
            ],
                [
                    'title' => $status['title'],
                    'description' => $status['description']
                ]
            );
        }
    }
}
