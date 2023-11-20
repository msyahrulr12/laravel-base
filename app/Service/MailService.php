<?php

namespace App\Service;

use App\Mail\ForgotPasswordRequest;
use Illuminate\Support\Facades\Mail;

class MailService
{
    public static function forgotPassword (
        $emailTo,
        $name,
        $link
    )
    {
        $subject = 'Lupa Password';
        $mail = Mail::to($emailTo)->send(new ForgotPasswordRequest(
            $subject,
            $name,
            $link
        ));

        return $mail;
    }
}
