<?php

namespace App\Services;
use Illuminate\Support\Facades\Mail;

class MailService
{

    public function sendMail($email_address, $email_content)
    {
        Mail::to($email_address)->send($email_content);
    }
}
