<?php

namespace App\Http\Controllers;

use App\Mail\ResearchMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ResearchMailController extends Controller
{
    public function email()
    {
        Mail::to('eduardo.eitelven@hotmail.com')->send(new ResearchMail());
    }
}
