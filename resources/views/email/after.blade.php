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
                                    <img style="width:88px; margin-bottom:24px;" src="http://ifca.paradiseindonesia.com/approvalmail/public/images/<?php echo $image ?>" alt="Verified">
                                    <p><?php echo $Pesan ?></p>
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