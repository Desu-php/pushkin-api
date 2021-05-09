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
        $statuses =[
            ['title'=>'В обработке', 'status' => 'in_progress'],
            ['title'=>'Не корректные данные', 'status' => 'in_correct'],
        ];

        foreach ($statuses as $status) {
            ApplicationStatus::create($status);
        }
    }
}
