<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\User;

class customRawtemplate extends Mailable
{
    use Queueable, SerializesModels;

    protected $html;
    public $subject;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject,$html)  {
        $this->html = $html;
        $this->subject = $subject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {

        return $this->view('emails.custom_raw_template.raw_template')->with([
                'html' => $this->html
        ]);

    }
}
