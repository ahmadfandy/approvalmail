<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailable\Content;
use Illuminate\Mail\Mailable\Envelope;
use Illuminate\Queue\SerializesModels;

class LastMail extends Mailable
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
            return $this->subject($this->dataEmail['module'].' No : '.$this->dataEmail['doc_no'].'  '.$this->dataEmail['entity_name'])
                    ->view('email.last.modify')
                    ->with(['data' => $this->dataEmail]);
        } else if ($this->dataEmail['status'] == 'R') {
            return $this->subject($this->dataEmail['module'].' No : '.$this->dataEmail['doc_no'].'  '.$this->dataEmail['entity_name'])
                    ->view('email.last.reject')
                    ->with(['data' => $this->dataEmail]);
        }else if ($this->dataEmail['flag'] == 'K') {
            return $this->subject($this->dataEmail['module'].' No : '.$this->dataEmail['contract_ref_no'].'  '.$this->dataEmail['entity_name'])
                    ->view('email.contract.last')
                    ->with(['data' => $this->dataEmail]);
        } else {
            return $this->subject($this->dataEmail['module'].' No : '.$this->dataEmail['doc_no'].'  '.$this->dataEmail['entity_name'])
                    ->view('email.last.last')
                    ->with(['data' => $this->dataEmail]);
        }
    }
}