<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Mail;
use App\Mail\PoMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class PoController extends Controller
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
                'project_no'    => $request->project_no,
                'trx_type'      => $request->trx_type,
                'doc_no'        => $request->doc_no,
                'user_id'       => $request->user_id,
                'level_no'      => $request->level_no,
                'status'        => $request->status,
                'reason'        => $request->reason,
                'profile_name'  => $request->profile_name,
                'flag'          => $request->flag,
                'descs'         => $request->descs,
                'creditor_name' => $request->creditor_name,
                'logo'          => $request->logo,
                'module'        => $request->module,
                'amount'        => $request->amount,
                'base'          => $request->base,
                'tax'           => $request->tax,
                'user_name'     => $request->user_name,
                'url_file'      => $link,
                'file_name'     => $link2,
                'sender'        => $request->sender,
                'entity_name'   => $request->entity_name,
                'email_addr'    => $email,
                'email_profile_addr'    => $request->email_profile_addr,
                'email_profile_name'    => $request->email_profile_name,
                'link'          => 'po'
            );

            try {
                $sendToEmail = strtolower($email);
                if(isset($sendToEmail) && !empty($sendToEmail) && filter_var($sendToEmail, FILTER_VALIDATE_EMAIL))
                {
                    Mail::to($sendToEmail)->send(new PoMail($dataEmail));
                    Log::channel('sendmail')->info('Email send to '.$sendToEmail.' Doc No : '.$request->doc_no );
                    return 'Email berhasil dikirim';
                }
            } catch (\Exception $e) {
                Log::channel('sendmail')->error('Gagal mengirim email: ' . $e->getMessage());              
                return "Gagal mengirim email. Cek log untuk detailnya.";
            }
        }
        
    }

    public function changestatus($entity_cd='',$project_no='', $trx_type='', $doc_no='', $user_id='', $level_no='', $status='', $profile='', $flag='', $entity_name='', $logo='', $module='')
    {
        $entity_name_r = str_replace('+', ' ', $entity_name);
        $module_r = str_replace('+', ' ', $module);
        $where2 = array(
            'order_no'        => $doc_no,
            'status'        => 'A',
            'entity_cd'     => $entity_cd,
            'level_no'      => $level_no,
        );

        $query = DB::connection('INPP_email')
        ->table('mgr.po_approver')
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
                $pdo = DB::connection('INPP_email')->getPdo();
                $sth = $pdo->prepare("SET NOCOUNT ON; EXEC mgr.x_approval_mail_po ?, ?, ?, ?, ?, ?, ?, ?, ?;");
                $sth->bindParam(1, $entity_cd);
                $sth->bindParam(2, $project_no);
                $sth->bindParam(3, $trx_type);
                $sth->bindParam(4, $doc_no);
                $sth->bindParam(5, $user_id);
                $sth->bindParam(6, $level_no);
                $sth->bindParam(7, $status);
                $sth->bindParam(8, $reason);
                $sth->bindParam(9, $flag);
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
                    $bgcolor = '#E5C552';
                    $valuebt  = 'Modify';
                } 
                else if($status == 'C')
                {
                    $name   = 'Cancellation';
                    $bgcolor = '#E57257';
                    $valuebt  = 'Reject';
                }

                $dataRevision = array(
                    'entity_cd' => $entity_cd,
                    'project_no' => $project_no,
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
                    'profile'    =>$profile,
                    'flag'    =>$flag
                );
                return view('email/po/revision', $dataRevision);
            }
        }
    }

    public function update(Request $request)
    {
        $entity_cd = $request->entity_cd;
        $project_no = $request->project_no;
        $trx_type = $request->trx_type;
        $doc_no = $request->doc_no;
        $user_id = $request->user_id;
        $level_no = $request->level_no;
        $status = $request->status;
        $profile = $request->profile;
        $flag = $request->flag;
        $reason = $request->reason;
        $module = $request->module;
        $entity_name = $request->entity_name;
        $logo = $request->logo;
        $pdo = DB::connection('INPP_email')->getPdo();
        $sth = $pdo->prepare("SET NOCOUNT ON; EXEC mgr.x_approval_mail_po ?, ?, ?, ?, ?, ?, ?, ?, ?;");
        $sth->bindParam(1, $entity_cd);
        $sth->bindParam(2, $project_no);
        $sth->bindParam(3, $trx_type);
        $sth->bindParam(4, $doc_no);
        $sth->bindParam(5, $user_id);
        $sth->bindParam(6, $level_no);
        $sth->bindParam(7, $status);
        $sth->bindParam(8, $reason);
        $sth->bindParam(9, $flag);
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
