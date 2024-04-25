<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="application/pdf">
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
                                    <img width="120" src="{{ url('public/images/' . $data['logo']) }}" alt="logo">
                                </td>
                                <td style="text-align: right; padding-bottom:25px">
                                        <p style="font-size: 16px; color: #026735; padding-top: 0px;"><?php echo $data['entity_name']; ?></p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table style="width:100%;max-width:620px;margin:0 auto;background-color:#E0E0DE;">
                        <tbody>
                            <tr>
                                <td style="padding: 30px 30px">
                                    <h5 style="text-align:left;margin-bottom: 24px; color: #000000; font-size: 20px; font-weight: 400; line-height: 28px;">Dear Mr./Mrs. {{ $data['user_name'] }}, </h5>
                                    <p style="text-align:left;margin-bottom: 15px; color: #000000; font-size: 16px;">
                                    <table style="padding-left: 40px;width: 100%; text-align:left;">             
                                            <tr>
                                                <td style="width :25%">Remarks</td>
                                                <td style="width :2%">:</td>
                                                <td >{{ $data['descs'] }}</td>
                                            </tr>
                                            <tr>
                                                <td>Total (Base Amount)</td>
                                                <td>:</td>
                                                <td>
                                                    <div style="float:left;width:8px">RP.</div>
                                                    <div style="text-align:right;width:27%">{{ $data['base'] }}</div>    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Total (Tax Amount)</td>
                                                <td>:</td>
                                                <td>
                                                    <div style="float:left;width:8px">RP.</div>
                                                    <div style="text-align:right;width:27%">{{ $data['tax'] }}</div>    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Total Amount</td>
                                                <td>:</td>
                                                <td>
                                                    <div style="float:left;width:8px">RP.</div>
                                                    <div style="text-align:right;width:27%">{{ $data['amount'] }}</div>  
                                                </td>
                                            </tr>
                              
                                        </table>
                                    </p><br>
                                    <p style="text-align:left;margin-bottom: 15px; color: #000000; font-size: 18px;"><b>Has Been Approved</b></p>
                                    <br>
                                    <p style="text-align:left;margin-bottom: 15px; color: #000000; font-size: 16px">
                                        <b style="font-style:italic;">Please find the attached file for your reference : </b><br>
                                        @if ($data['url_file'] != 'EMPTY')
                                            @if ( is_array($data['url_file']) || is_object($data['url_file']) )
                                                @foreach ($data['url_file'] as $tampil)
                                                    <a href={{ $tampil }} target="_blank">{{ trim(str_replace('%20', ' ',substr($tampil, strrpos($tampil, '/') + 1))) }}</a><br><br>
                                                @endforeach
                                            @else
                                                <a href={{ $data['url_file'] }} target="_blank">{{ trim(str_replace('%20', ' ',substr($data['url_file'], strrpos($data['url_file'], '/') + 1))) }}</a><br><br>
                                            @endif
                                        @endif
                                    </p>
                                    <br>
                                    <p style="text-align:left;margin-bottom: 15px; color: #000000; font-size: 16px;">
                                        <b>Thanks & Regards,</b><br>
                                        {{ $data['sender'] }}
                                    </p><br>
                                </td>
                            </tr>
                        </tbody>
                        <br><br><br><div style="text-align:left;color: #000000; font-size: 13px;">
                                        <i>*note : do not reply this email</i>
                                    </div>
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