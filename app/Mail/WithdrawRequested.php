<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WithdrawRequested extends Mailable
{
    use Queueable, SerializesModels;

    public $email_data_object;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email_data_object)
    {
        $this->email_data_object = $email_data_object;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->email_data_object->subject = 'Confirm withdraw request!';

        return $this->to($this->email_data_object->user_email, $this->email_data_object->user_name)
        ->view('emails.withdraw-requested')
        ->subject($this->email_data_object->subject);
    }
}
