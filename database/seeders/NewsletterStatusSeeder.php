<?php

namespace Database\Seeders;

use App\Models\NewsletterStatus;
use Illuminate\Database\Seeder;

class NewsletterStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $statuses =[
            ['title'=>'В очереди', 'status' => 'in_queue'],
            ['title'=>'Успешно', 'status' => 'successful'],
            ['title'=>'Неудачно', 'status' => 'unsuccessful'],
        ];

        foreach ($statuses as $status){
            NewsletterStatus::create($status);
        }
    }
}
