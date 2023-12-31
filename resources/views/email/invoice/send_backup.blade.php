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
                                <td style="text-align: center; padding-bottom:25px">
                                    <img width="120" src="{{ url('public/images/' . $data['logo']) }}" alt="logo">
                                        <p style="font-size: 16px; color: #026735; padding-top: 0px;">{{ $data['entity_name'] }}</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table style="width:100%;max-width:620px;margin:0 auto;background-color:#ffff67;">
                        <tbody>
                            <tr>
                                <td style="padding: 30px 30px">
                                    <h5 style="text-align:left;margin-bottom: 24px; color: #000000; font-size: 20px; font-weight: 400; line-height: 28px;">Dear Mr./Mrs. {{ $data['user_name'] }}, </h5>
                                    <p style="text-align:left;margin-bottom: 15px; color: #000000; font-size: 16px;">{{ $data['descs'] }}.</p><br>
                                    <a href="{{ url('api') }}/{{ $data['link'] }}/{{ $data['entity_cd'] }}/{{ $data['trx_type'] }}/{{ $data['doc_no'] }}/{{ $data['user_id'] }}/{{ $data['level_no'] }}/A/{{ $data['profile_name'] }}/{{ $data['entity_name'] }}/{{ $data['logo'] }}/{{ $data['module'] }}" style="display: inline-block; font-size: 13px; font-weight: 600; line-height: 20px; text-align: center; text-decoration: none; text-transform: uppercase; padding: 10px 40px; background-color: #1ee0ac; border-radius: 4px; color: #ffffff;">Approve</a>
                                    <a href="{{ url('api') }}/{{ $data['link'] }}/{{ $data['entity_cd'] }}/{{ $data['trx_type'] }}/{{ $data['doc_no'] }}/{{ $data['user_id'] }}/{{ $data['level_no'] }}/R/{{ $data['profile_name'] }}/{{ $data['entity_name'] }}/{{ $data['logo'] }}/{{ $data['module'] }}" style="display: inline-block; font-size: 13px; font-weight: 600; line-height: 20px; text-align: center; text-decoration: none; text-transform: uppercase; padding: 10px 40px; background-color: #f4bd0e; border-radius: 4px; color: #ffffff;">Revise</a>
                                    <a href="{{ url('api') }}/{{ $data['link'] }}/{{ $data['entity_cd'] }}/{{ $data['trx_type'] }}/{{ $data['doc_no'] }}/{{ $data['user_id'] }}/{{ $data['level_no'] }}/C/{{ $data['profile_name'] }}/{{ $data['entity_name'] }}/{{ $data['logo'] }}/{{ $data['module'] }}" style="display: inline-block; font-size: 13px; font-weight: 600; line-height: 20px; text-align: center; text-decoration: none; text-transform: uppercase; padding: 10px 40px; background-color: #e85347; border-radius: 4px; color: #ffffff;">Cancel</a>
                                    <br>
                                    <p style="text-align:left;margin-bottom: 15px; color: #000000; font-size: 16px">
                                        <b style="font-style:italic;">Untuk melihat lampiran, tolong klik tautan dibawah ini : </b><br>
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
                                    <br><p style="text-align:left;margin-bottom: 15px; color: #000000; font-size: 16px;">
                                        <b>Thank you,</b><br>
                                        {{ $data['sender'] }}
                                    </p><br>
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