<?php
  
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
  
class DemoMail extends Mailable
{
    use Queueable, SerializesModels;
  
    public $mailData;
    public $pdf;
  
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mailData, $pdf)
    {
        $this->mailData = [
            'title' => '¡HOLA!',
            'body' => 'Esta es la factura de su cuota:'
        ];

        $this->pdf = $pdf;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        
        return $this->subject('Mail from andrea@nosecaen.org')
                    ->view('emails.demoMail')
                    ->attachData($this->pdf->output(), 'factura.pdf');

    }
}