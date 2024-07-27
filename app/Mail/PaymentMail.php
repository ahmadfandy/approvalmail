<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailable\Content;
use Illuminate\Mail\Mailable\Envelope;
use Illuminate\Queue\SerializesModels;

class PaymentMail extends Mailable
{
    use Queueable, SerializesModels;

    public $dataEmail;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($dataEmail)
    {
        $this->dataEmail = $dataEmail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($address = $this->dataEmail['email_profile_addr'], $name = $this->dataEmail['email_profile_name'])
                    ->subject('Need Approval Payment No : '.$this->dataEmail['doc_no'].'  '.$this->dataEmail['entity_name'])
                    ->view('email.payment.send')
                    ->with(['data' => $this->dataEmail]);
    }
}
