<?php

namespace App\Http\Controllers;

use App\Mail\EmailModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    // public function sendEmail(){
    //     $toEmail = 'pradhantrilocha342@gmail.com';
    //     $message = 'Welcome to Your website';
    //     $subject = 'Welcome pradhantrilochan';

    //     $requrest = Mail::to($toEmail)->send(new EmailModel($message,$subject));
    //    dd($requrest);
    // }
}
