<?php

namespace App\Mail;

use App\Models\Poem;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PoemDetailsEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $poem;

    public function __construct(Poem $poem)
    {
        $this->poem = $poem;
    }

    public function build()
    {
        return $this->view('emails.poems.details')
                    ->subject('Your Poem Details Request');
    }
}
