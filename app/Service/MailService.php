<?php

namespace App\Service;

use App\Helpers\DateHelper;
use App\Helpers\Formatter;
use App\Mail\BorrowerRenewalLending;
use App\Mail\BorrowerRenewalLendingSuccess;
use App\Mail\BorrowerReturned;
use App\Mail\SetDefaultPassword;
use App\Mail\EmailGeneral;
use App\Mail\ForgotPasswordRequest;
use App\Mail\FundingRequest;
use App\Mail\LenderRefundLending;
use App\Mail\LendingDueDateReminder;
use App\Mail\ReportError;
use App\Models\LenderBankVirtualAccount;
use App\Models\Lending;
use App\Models\PaymentScheduleBorrower;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Console\Helper\FormatterHelper;

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
