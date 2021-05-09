<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\App;
use PDF;

class NewslettersSend extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     *
     */
    private $contestant;
    public function __construct($contestant)
    {
        //
        $this->contestant = $contestant;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('pdf.pdf', ['contestant' => $this->contestant])->save(storage_path('app/doc.pdf'));
        return $this->attach(storage_path('app/doc.pdf'),[
            'as' => 'Грамота',
        ])->subject('Грамота за участие');
    }
}
