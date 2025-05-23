<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="x-apple-disable-message-reformatting">
    <title></title>
    
    <link href="https://fonts.googleapis.com/css?family=Vollkorn:400,600" rel="stylesheet" type="text/css">
    <style>
        body {
            font-family: Vollkorn;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</head>

<body width="100%" style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color: #ffffff;">
	<div style="width: 100%; background-color: #ffffff; text-align: center;">
        <table width="80%" border="0" cellpadding="0" cellspacing="0" bgcolor="#ffffff" style="margin-left: auto;margin-right: auto;" >
            <tr>
               <td style="padding: 40px 0;">
                    <table style="width:100%;max-width:620px;margin:0 auto;">
                        <tbody>
                            <tr>
                                <td style="text-align: left; padding-bottom:25px">
                                    <img width="120" src="{{ url('public/images/' . $logo) }}" alt="logo">
                                </td>
                                <td style="text-align: right; padding-bottom:25px">
                                        <p style="font-size: 16px; color: #026735; padding-top: 0px;"><?php echo $entity_name; ?></p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table style="width:100%;max-width:620px;margin:0 auto;background-color:#E0E0DE;">
                        <tbody>
                            <tr>
                                <td style="text-align:center;padding: 50px 30px;">
                                    <img style="width:88px; margin-bottom:24px;" src="{{ url('public/images/double_approve.png') }}" alt="Verified">
                                    <p>Please Give a Reason to <?php echo $doc_no?> <?php echo $name?> : </p>
                                    <form id="frmEditor" class="form-horizontal" method="POST" action="{{url('/api/invoice/update')}}" enctype="multipart/form-data">
                                    @csrf
                                        <input type="text" id="entity_cd" name="entity_cd" value="<?php echo $entity_cd?>" hidden>
                                        <input type="text" id="project_no" name="project_no" value="<?php echo $project_no?>" hidden>
                                        <input type="text" id="trx_type" name="trx_type" value="<?php echo $trx_type?>" hidden>
                                        <input type="text" id="doc_no" name="doc_no" value="<?php echo $doc_no?>" hidden>
                                        <input type="text" id="user_id" name="user_id" value="<?php echo $user_id?>" hidden>
                                        <input type="text" id="level_no" name="level_no" value="<?php echo $level_no?>" hidden>
                                        <input type="text" id="status" name="status" value="<?php echo $status?>" hidden>
                                        <input type="text" id="profile" name="profile" value="<?php echo $profile?>" hidden>
                                        <input type="text" id="flag" name="flag" value="<?php echo $flag?>" hidden>
                                        <input type="text" id="entity_name" name="entity_name" value="<?php echo $entity_name?>" hidden>
                                        <input type="text" id="logo" name="logo" value="<?php echo $logo?>" hidden>
                                        <input type="text" id="module" name="module" value="<?php echo $module?>" hidden>
                                        <div class="form-group">
                                            <textarea class="form-control" id="reason" name="reason" rows="3"></textarea>
                                        </div>                                          
                                        <input type="submit" class="btn" style="background-color:<?php echo $bgcolor?>;color:#ffffff;display:inline-block;font-size:13px;font-weight:600;line-height:44px;text-align:center;text-decoration:none;text-transform: uppercase; padding: 0px 40px;margin: 10px" value=<?php echo $valuebt?>>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table style="width:100%;max-width:620px;margin:0 auto;">
                        <tbody>
                            <tr>
                                <td style="text-align: center; padding:25px 20px 0;">
                                    <p style="font-size: 13px;">Copyright © 2023 IFCA Software. All rights reserved.</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
               </td>
            </tr>
        </table>
    </div>
</body>
</html>