<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

class TestController extends Controller
{
    public function email_send(){
        try {
             $toEmail = 'himanshumiddha24@gmail.com'; 
             Mail::to($toEmail)->send(new SendMail());
             return "Email sent successfully!";
        } catch (\Throwable $th) {
            return $th;
        }
    }
}