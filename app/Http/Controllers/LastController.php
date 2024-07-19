<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Mail;
use App\Mail\LastMail;
use Illuminate\Support\Facades\DB;


class LastController extends Controller
{
    public function mail(Request $request)
    {
        $callback = array(
            'data' => null,
            'Error' => false,
            'Pesan' => '',
            'Status' => 200
        );

        $newurl2 = explode(";", trim(str_replace(' ','',$request->url_file)));
        $file_name2 = explode(";", trim(str_replace(' ','',$request->file_name)));
        $email_addr = explode(";", trim(str_replace(' ','',$request->email_addr)));

        foreach ($newurl2 as $show)
        {
            $link[] = $show;
        }

        foreach ($file_name2 as $show2)
        {
            $link2[] = $show2;
        }

        foreach ($email_addr as $email) {
            $dataEmail = array(
                'entity_cd'     => $request->entity_cd,
                'trx_type'      => $request->trx_type,
                'doc_no'        => $request->doc_no,
                'level_no'      => $request->level_no,
                'user_id'       => $request->user_id,
                'status'        => $request->status,
                'reason'        => $request->reason,
                'profile_name'  => $request->profile_name,
                'flag'          => $request->flag,
                'descs'         => $request->descs,
                'pay_to'        => $request->pay_to,
                'creditor_name' => $request->creditor_name,
                'request_no'    => $request->request_no,
                'prev_progress' => $request->prev_progress,
                'curr_progress' => $request->curr_progress,
                'contract_no'   => $request->contract_no,
                'contract_remarks'  => $request->contract_remarks,
                'cumulative_progress'  => $request->cumulative_progress,
                'type_prog'     => $request->type_prog,
                'vo_no'         => $request->vo_no,
                'vo_descs'      => $request->vo_descs,
                'vo_count'      => $request->vo_count,
                'pr_descs'        => $request->pr_descs,
                'amount'        => $request->amount,
                'cost_cd_descs' => $request->cost_cd_descs,
                'base'          => $request->base,
                'tax'           => $request->tax,
                'logo'          => $request->logo,
                'module'        => $request->module,
                'contract_ref_no' => $request->contract_ref_no,
                'user_name'     => $request->user_name,
                'url_file'      => $link,
                'file_name'     => $link2,
                'sender'        => $request->sender,
                'entity_name'   => $request->entity_name,
                'email_addr'    => $email,
                'email_profile_addr'    => $request->email_profile_addr,
                'email_profile_name'    => $request->email_profile_name,
                'link'          => 'last'
            );
    
            $sendToEmail = strtolower($email);
            if(isset($sendToEmail) && !empty($sendToEmail) && filter_var($sendToEmail, FILTER_VALIDATE_EMAIL))
            {
                Mail::to($sendToEmail)
                    ->send(new LastMail($dataEmail));
                $callback['Error'] = false;
                $callback['Pesan'] = 'sendToEmail';
                echo json_encode($callback);
            }
        }
        
    }
}
