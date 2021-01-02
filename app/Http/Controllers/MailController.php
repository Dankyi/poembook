<?php

namespace App\Http\Controllers;

use App\Mail\PoemDetailsEmail;
use App\Models\Poem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendPoemDetails (Poem $poem)
    {
        Mail::to (Auth::user()->email)
            -> send (new PoemDetailsEmail($poem));

        return redirect()-> back ();
    }
}
