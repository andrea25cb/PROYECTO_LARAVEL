<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
class PDFController extends Controller
{
    /**  Sends an email with PDF.*/
    public function sendMailWithPDF()
    {
        $data["email"] = "test@gmail.com";
        $data["title"] = "Welcome to Edinson";
        $data["body"] = "This is the email body.";

        $pdf = PDF::loadView('myPDF', $data);

        Mail::send('emails.demoMail', $data, function ($message) use ($data, $pdf) {
            $message->to($data["email"], $data["email"])
                ->subject($data["title"])
                ->attachData($pdf->output(), "test.pdf");
        });

        dd('Email has been sent successfully');
    }
}