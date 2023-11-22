<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvoiceMail;
use Illuminate\Support\Facades\DB;


class InvoiceController extends Controller
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
                'trx_type'    => $request->trx_type,
                'doc_no'        => $request->doc_no,
                'level_no'      => $request->level_no,
                'user_id'       => $request->user_id,
                'status'        => $request->status,
                'reason'        => $request->reason,
                'profile_name'        => $request->profile_name,
                'descs'        => $request->descs,
                'logo'          => $request->logo,
                'pr_type'          => $request->pr_type,
                'module'          => $request->module,
                'user_name'        => $request->user_name,
                'url_file'        => $link,
                'file_name'        => $link2,
                'sender'        => $request->sender,
                'entity_name'        => $request->entity_name,
                'email_addr'        => $email,
                'link'          => 'porequest'
            );

            $sendToEmail = strtolower($email);
            if(isset($sendToEmail) && !empty($sendToEmail) && filter_var($sendToEmail, FILTER_VALIDATE_EMAIL))
            {
                Mail::to($sendToEmail)
                    ->send(new InvoiceMail($dataEmail));
                $callback['Error'] = false;
                $callback['Pesan'] = 'sendToEmail';
                echo json_encode($callback);
            }
        }
        
    }

    public function changestatus($entity_cd='', $trx_type='', $doc_no='', $user_id='', $level_no='', $status='', $profile='', $entity_name='', $logo='', $module='')
    {
        $entity_name_r = str_replace('+', ' ', $entity_name);
        $module_r = str_replace('+', ' ', $module);
        $where2 = array(
            'doc_no'        => $doc_no,
            'status'        => 'A',
            'entity_cd'     => $entity_cd,
            'level_no'      => $level_no,
            'trx_type'      => $trx_type,
        );

        $query = DB::connection('INPP')
        ->table('mgr.po_authorized_person')
        ->where($where2)
        ->get();

        if(count($query)>0) {
            $msg = 'You Have Already Made a Request to '.$module_r.' '.$doc_no ;
            $notif = 'Restricted !';
            $st  = 'OK';
            $image = "double_approve.png";
            $msg1 = array(
                "Pesan" => $msg,
                "St" => $st,
                "notif" => $notif,
                "image" => $image,
                "entity_name"   => $entity_name_r,
                "logo"   => $logo
            );
            return view("email.after", $msg1);
        } else {
            if($status == 'A') {
                $reason = '';
                $pdo = DB::connection('INPP')->getPdo();
                $sth = $pdo->prepare("SET NOCOUNT ON; EXEC mgr.xcb_mobile_appproval_pr ?, ?, ?, ?, ?, ?, ?, ?;");
                $sth->bindParam(1, $entity_cd);
                $sth->bindParam(2, $trx_type);
                $sth->bindParam(3, $doc_no);
                $sth->bindParam(4, $user_id);
                $sth->bindParam(5, $level_no);
                $sth->bindParam(6, $status);
                $sth->bindParam(7, $reason);
                $sth->bindParam(8, $profile);
                $sth->execute();
                if ($sth == true) {
                    $msg = "You Have Successfully Approved the  ".$module_r." ".$doc_no ;
                    $notif = 'Approved !';
                    $st = 'OK';
                    $image = "approved.png";
                } else {
                    $msg = "You Failed to Approved the  ".$module_r." ".$doc_no ;
                    $notif = 'Fail to Approve !';
                    $st = 'OK';
                    $image = "reject.png";
                }
                $msg1 = array(
                    "Pesan" => $msg,
                    "St" => $st,
                    "image" => $image,
                    "notif" => $notif,
                    "entity_name"   => $entity_name_r,
                    "logo"   => $logo
                );
                return view("email.after", $msg1);
            } else {
                if($status == 'R')
                {
                    $name   = 'Revision';
                    $bgcolor = '#f4bd0e';
                    $valuebt  = 'Modify';
                } 
                else if($status == 'C')
                {
                    $name   = 'Cancellation';
                    $bgcolor = '#f4bd0e';
                    $valuebt  = 'Reject';
                }

                $dataRevision = array(
                    'entity_cd' => $entity_cd,
                    'name'      => $name,
                    'bgcolor'      => $bgcolor,
                    'valuebt'      => $valuebt,
                    'trx_type'  => $trx_type, 
                    'doc_no'    => $doc_no, 
                    'user_id'    => $user_id, 
                    'level_no'  => $level_no,
                    'entity_name'    => $entity_name_r, 
                    'logo'  => $logo,
                    'module'  => $module_r,
                    'status'     =>$status, 
                    'profile'    =>$profile
                );
                return view('email/invoice/revision', $dataRevision);
            }
        }
    }

    public function update(Request $request)
    {
        $entity_cd = $request->entity_cd;
        $trx_type = $request->trx_type;
        $doc_no = $request->doc_no;
        $doc_date = $request->doc_date;
        $user_id = $request->user_id;
        $level_no = $request->level_no;
        $status = $request->status;
        $profile = $request->profile;
        $reason = $request->reason;
        $module = $request->module;
        $entity_name = $request->entity_name;
        $logo = $request->logo;
        $pdo = DB::connection('INPP')->getPdo();
        $sth = $pdo->prepare("SET NOCOUNT ON; EXEC mgr.xcb_mobile_appproval_pr ?, ?, ?, ?, ?, ?, ?, ?;");
        $sth->bindParam(1, $entity_cd);
        $sth->bindParam(2, $trx_type);
        $sth->bindParam(3, $doc_no);
        $sth->bindParam(4, $user_id);
        $sth->bindParam(5, $level_no);
        $sth->bindParam(6, $status);
        $sth->bindParam(7, $reason);
        $sth->bindParam(8, $profile);
        $sth->execute();
        if ($sth == true) {
            if ($status == "R") {
                $text = 'Revision';
            } else if ($status == "C"){
                $text = 'Rejected';
            }
            $msg = "You Have Successfully Made a ".$text." Request on ".$module." ".$doc_no." with a reason " .$reason;
            $notif = 'Revised !';
            $st = 'OK';
            $image = "revise.png";
        } else {
            if ($status == 'R') {
                $msg = "You Failed to Make a ".$text." Request on ".$module." ".$doc_no;
                $notif = 'Fail to Revised !';
                $st = 'OK';
                $image = "reject.png";
            }
        }
        $msg1 = array(
            "Pesan" => $msg,
            "St" => $st,
            "notif" => $notif,
            "image" => $image,
            "entity_name"   => $entity_name,
            "logo"   => $logo
        );
        return view("email.after", $msg1);
    }
}
