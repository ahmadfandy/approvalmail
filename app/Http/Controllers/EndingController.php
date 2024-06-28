<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Mail;
use App\Mail\EndingMail;
use Illuminate\Support\Facades\DB;


class EndingController extends Controller
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
	$filename2 =explode(";", trim(str_replace(' ','',$request->file_name)));
        $email_addr = explode(";", trim(str_replace(' ','',$request->email_addr)));

	foreach($newurl2 as $show)
	{
		$link[]=$show;
	}

	foreach($filename2 as $show2)
	{
		$link2[]=$show2;
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
                'user_name'        => $request->user_name,
                'url_file'        => $link,
                'file_name'        => $link2,
                'sender'        => $request->sender,
                'entity_name'        => $request->entity_name,
                'email_addr'        => $email,
                'email_profile_addr'    => $request->email_profile_addr,
                'email_profile_name'    => $request->email_profile_name,
                'link'          => 'porequest'
            );
    
            $sendToEmail = strtolower($email);
            if(isset($sendToEmail) && !empty($sendToEmail) && filter_var($sendToEmail, FILTER_VALIDATE_EMAIL))
            {
                Mail::to($sendToEmail)
                    ->send(new EndingMail($dataEmail));
                $callback['Error'] = false;
                $callback['Pesan'] = 'sendToEmail';
                echo json_encode($callback);
            }
        }
        
    }
}
