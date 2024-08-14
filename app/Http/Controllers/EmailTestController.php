<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailTestController extends Controller
{
    public function sendTestEmail()
    {
        $toEmail = 'djabirtairou@gmail.com';
        $body = 'This is a test email sent from Tikerama.';

        Mail::to($toEmail)->send(new \App\Mail\TestEmail($body));

        return 'Test email sent!';
    }
}
