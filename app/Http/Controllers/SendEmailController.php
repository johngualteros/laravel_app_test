<?php

namespace App\Http\Controllers;

use App\Mail\ReportUsers;
use App\Mail\UserCreatedMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SendEmailController extends Controller
{
    public function index($email)
    {
      Mail::to($email)->send(new UserCreatedMail());
    } 

    public function sendMultipleEmailsWithReport($email) {
        Mail::to($email)->send(new ReportUsers());
    }
}
