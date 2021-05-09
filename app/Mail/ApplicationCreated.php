<?php

namespace App\Mail;

use App\Models\Application;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ApplicationCreated extends Mailable
{
    use Queueable, SerializesModels;

    public Application $application;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Application $application)
    {
        $this->application = $application;

        $files = $application->files;
        foreach($files as $file){
            $this->files[] = storage_path('app/applications/' . $application->id . '/' . $file->name);
        }

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email = $this->markdown('emails.application-created')
            ->subject($this->application->contest->title);

            foreach($this->files as $filePath){
                $email->attach($filePath);
            }

        return $email;
    }
}
