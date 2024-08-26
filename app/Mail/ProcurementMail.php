<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailable\Content;
use Illuminate\Mail\Mailable\Envelope;
use Illuminate\Queue\SerializesModels;

class ProcurementMail extends Mailable
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
        if ($this->dataEmail['status'] == 'M') {
            return $this->from($address = $this->dataEmail['email_profile_addr'], $name = $this->dataEmail['email_profile_name'])
                    ->subject('Request No.  '.$this->dataEmail['doc_no'].'  '.$this->dataEmail['entity_name'])
                    ->view('email.modify')
                    ->with(['data' => $this->dataEmail]);
        } else if ($this->dataEmail['status'] == 'R') {
            return $this->from($address = $this->dataEmail['email_profile_addr'], $name = $this->dataEmail['email_profile_name'])
                    ->subject('Request No.  '.$this->dataEmail['doc_no'].'  '.$this->dataEmail['entity_name'])
                    ->view('email.reject')
                    ->with(['data' => $this->dataEmail]);
        } else {
            return $this->from($address = $this->dataEmail['email_profile_addr'], $name = $this->dataEmail['email_profile_name'])
                    ->subject('Request No.  '.$this->dataEmail['doc_no'].'  '.$this->dataEmail['entity_name'])
                    ->view('email.ending')
                    ->with(['data' => $this->dataEmail]);
        }
    }
}