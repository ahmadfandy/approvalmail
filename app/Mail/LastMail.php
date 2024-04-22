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
            return $this->subject('Modify : '.$this->dataEmail['module'].' No : '.$this->dataEmail['doc_no'].'  '.$this->dataEmail['entity_name'])
                    ->view('email.last.modify')
                    ->with(['data' => $this->dataEmail]);
        } else if ($this->dataEmail['status'] == 'R') {
            return $this->subject('Rejected : '.$this->dataEmail['module'].' No : '.$this->dataEmail['doc_no'].'  '.$this->dataEmail['entity_name'])
                    ->view('email.last.reject')
                    ->with(['data' => $this->dataEmail]);
        }else if ($this->dataEmail['flag'] == 'K') {
            return $this->subject('Approved : '.$this->dataEmail['module'].' No : '.$this->dataEmail['doc_no'].'  '.$this->dataEmail['entity_name'])
                    ->view('email.contract.last')
                    ->with(['data' => $this->dataEmail]);
        }
        else if ($this->dataEmail['flag'] == 'SS') {
            return $this->subject('Supplier Selection On Request No : '.$this->dataEmail['request_no'].'  '.$this->dataEmail['entity_name'])
                    ->view('email.supplier.last')
                    ->with(['data' => $this->dataEmail]);
        }else if ($this->dataEmail['flag'] == 'B') {
            return $this->subject('Approved : '.$this->dataEmail['module'].' No : '.$this->dataEmail['doc_no'].'  '.$this->dataEmail['entity_name'])
                    ->view('email.budget.last')
                    ->with(['data' => $this->dataEmail]);
        }else if ($this->dataEmail['flag'] == 'R') {
            return $this->subject('Approved : '.$this->dataEmail['module'].' No : '.$this->dataEmail['doc_no'].'  '.$this->dataEmail['entity_name'])
                    ->view('email.revisebudget.last')
                    ->with(['data' => $this->dataEmail]);
        }else if ($this->dataEmail['type_prog'] == 'V' AND $this->dataEmail['flag'] == 'P')  {
            return $this->subject('Approved : '.$this->dataEmail['module'].' No : '.$this->dataEmail['doc_no'].'  '.$this->dataEmail['entity_name'])
                    ->view('email.progressvo.last')
                    ->with(['data' => $this->dataEmail]);
        }else if ($this->dataEmail['type_prog'] == 'C' AND $this->dataEmail['flag'] == 'P') {
            return $this->subject('Approved : '.$this->dataEmail['module'].' No : '.$this->dataEmail['doc_no'].'  '.$this->dataEmail['entity_name'])
                    ->view('email.progress.last')
                    ->with(['data' => $this->dataEmail]);
        }  else {
            return $this->subject('Approved : '.$this->dataEmail['module'].' No : '.$this->dataEmail['doc_no'].'  '.$this->dataEmail['entity_name'])
                    ->view('email.last.last')
                    ->with(['data' => $this->dataEmail]);
        }
    }
}