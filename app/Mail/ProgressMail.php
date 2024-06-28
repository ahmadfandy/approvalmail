<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailable\Content;
use Illuminate\Mail\Mailable\Envelope;
use Illuminate\Queue\SerializesModels;

class ProgressMail extends Mailable
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
        if ($this->dataEmail['type_prog'] == 'V') {
        return $this->from($address = $this->dataEmail['email_profile_addr'], $name = $this->dataEmail['email_profile_name'])
                    ->subject('Need Approval '.$this->dataEmail['module'].' No : '.$this->dataEmail['doc_no'].'  '.$this->dataEmail['entity_name'])
                    ->view('email.progressvo.send')
                    ->with(['data' => $this->dataEmail]);
        }else{
            return $this->from($address = $this->dataEmail['email_profile_addr'], $name = $this->dataEmail['email_profile_name'])
                    ->subject('Need Approval '.$this->dataEmail['module'].' No : '.$this->dataEmail['doc_no'].'  '.$this->dataEmail['entity_name'])
                    ->view('email.progress.send')
                    ->with(['data' => $this->dataEmail]);
        }
    }
}
