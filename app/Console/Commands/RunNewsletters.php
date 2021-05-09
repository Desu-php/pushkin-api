<?php

namespace App\Console\Commands;

use App\Mail\NewslettersSend;
use App\Models\Newsletter;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Mail;

class RunNewsletters extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run:newsletters';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'this command run newsletters';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
      $newsletter = Newsletter::whereHas('status', function (Builder $builder){
            $builder->where('status', 'in_queue');
        })->first();
        try {
            if (!empty($newsletter)){
                Mail::to($newsletter->contestant->email)
                    ->send(new NewslettersSend($newsletter->contestant));
            }
        }catch (\Exception $exception){
            $newsletter->status_id = 3;
            $newsletter->save();
        }
        $newsletter->status_id = 2;
        $newsletter->save();
        return 0;
    }
}
