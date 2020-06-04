<!DOCTYPE html>
<html >
    <head>
        <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,400i,700,700i,900,900i" rel="stylesheet" />
        <title>Email Template</title>

        <style type="text/css" media="screen">
            /* Linked Styles */
            body { padding:0 !important; margin:0 !important; display:block !important; min-width:100% !important; width:100% !important; background:#f3f4f6; -webkit-text-size-adjust:none }
            a { color:#000001; text-decoration:none }
            p { padding:0 !important; margin:0 !important } 
            img { -ms-interpolation-mode: bicubic; /* Allow smoother rendering of resized image in Internet Explorer */ }
            .mcnPreviewText { display: none !important; }


            /* Mobile styles */
            @media only screen and (max-device-width: 480px), only screen and (max-width: 480px) {
                .mobile-shell { width: 100% !important; min-width: 100% !important; }
                .bg { background-size: 100% auto !important; -webkit-background-size: 100% auto !important; }

                .text-header,
                .m-center { text-align: center !important; }

                .center { margin: 0 auto !important; }
                .container { padding: 20px 10px !important }

                .td { width: 100% !important; min-width: 100% !important; }

                .m-br-15 { height: 15px !important; }
                .p30-15 { padding: 30px 15px !important; }
                .p0-15-30 { padding: 0px 15px 30px 15px !important; }
                .mpb30 { padding-bottom: 30px !important; }

                .m-td,
                .m-hide { display: none !important; width: 0 !important; height: 0 !important; font-size: 0 !important; line-height: 0 !important; min-height: 0 !important; }

                .m-block { display: block !important; }

                .fluid-img img { width: 100% !important; max-width: 100% !important; height: auto !important; }

                .column,
                .column-dir,
                .column-top,
                .column-empty,
                .column-empty2,
                .column-dir-top { float: left !important; width: 100% !important; display: block !important; }

                .column-empty { padding-bottom: 30px !important; }
                .column-empty2 { padding-bottom: 10px !important; }

                .content-spacing { width: 15px !important; }
            }
        </style>
    </head>
    <body class="body" style="padding:0 !important; margin:0 !important; display:block !important; min-width:100% !important; width:100% !important; background:#f3f4f6; -webkit-text-size-adjust:none;">
        <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#f3f4f6">
            <tr>
                <td align="center" valign="top">
                    <table width="650" border="0" cellspacing="0" cellpadding="0" class="mobile-shell">
                        <tr>
                            <td class="td container" style="width:650px; min-width:650px; font-size:0pt; line-height:0pt; margin:0; font-weight:normal; padding:55px 0px;">
                                <!-- Header -->
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td class="p30-15 tbrr" style="padding: 30px; border-radius:26px 26px 0px 0px;" bgcolor="#ffffff">
                                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                <tr>
                                                    <th class="column-top" width="145" style="font-size:0pt; line-height:0pt; padding:0; margin:0; font-weight:normal; vertical-align:top;">
                                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                            <tr>
                                                                <td class="img m-center" style="font-size:0pt; line-height:0pt; text-align:left;">
                                                                    <img src="https://www.weunite91.com/public/frontend/image/united-91.png" style="width: 100px;" border="0" alt="" />
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </th>
                                                    <th class="column-empty2" width="1" style="font-size:0pt; line-height:0pt; padding:0; margin:0; font-weight:normal; vertical-align:top;"></th>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                                <!-- END Header -->



                                <!-- Intro -->
                                <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff" style="padding-top: 30px">
                                    <tr>
                                        <td style="padding-bottom: 10px;">
                                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                <tr>
                                                    <td class="p30-15" style="padding: 10px 30px;">
                                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                        <tr>
                                                        <td class="text-center pb25" style="color:#666666; font-family:'Muli', 
                                                                                            Arial,sans-serif; font-size:16px; line-height:30px;
                                                                                             text-align:left; padding-bottom:25px;">
                                                                Dear {{ $data['firstname']." ".$data['lastname']}},
                                                         </td>
                                                            </tr>
                                                            
                                                            <tr>
                                                                <td class="pb25" style="color:#666666; font-family:'Muli', 
                                                                                            Arial,sans-serif; font-size:16px; line-height:30px;
                                                                                             text-align:center; padding-bottom:15px;">
                                                              There was a request to change your password

                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td class="pb25" style="color:#666666; font-family:'Muli', 
                                                                                            Arial,sans-serif; font-size:16px; line-height:30px;
                                                                                             text-align:center; padding-bottom:25px;">
                                                               
                                                               Tap the below link to reset your password.

                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td class="text-center pb25" style="color:#666666; font-family:'Muli', Arial,sans-serif; font-size:16px; line-height:30px; text-align:center; padding-bottom:25px;">
                                                                <a style="height:50px !important;background-color:blue !important;
                                                                          color:white;border-radius:8px;padding:12px !important" 
                                                                href="{{ route("resetpassword",$data['token']) }}">
                                                                  Reset Password 
                                                                </a></td>
                                                                    </tr>

                                                            
                                                                <tr>
                                                                <td class="text-center pb25" style="color:#666666; font-family:'Muli', Arial,sans-serif; font-size:16px; line-height:30px; text-align:center; padding-bottom:25px;">
                                                                If you didn’t request a new password, kindly ignore/delete this email.</td>
                                                            </tr>

                                                            <tr>
                                                                <td class="pb25" style="color:#666666; font-family:'Muli', Arial,sans-serif; 
                                                                font-size:16px; line-height:30px; text-align:left; padding-bottom:25px;">
                                                                Thanks,<br/>
                                                                Security<br/>
                                                                WE UNITE 91<br/>

                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="pb25" style="color:#666666; font-family:'Muli', Arial,sans-serif; 
                                                                font-size:10px; line-height:30px; text-align:left; padding-bottom:25px;">
                                                            <b> IMPORTANT:</b>
                                                                (This email is a strictly confidential communication to and solely for the use of the recipient and may note be reproduced or circulated without WE UNITE 91’s prior written consent.  If you are not the intended recipient, you may not disclose or use the information in this email in any way.  The information is not intended as an offer or solicitation with respect to the purchase or sale of any security.)

                                                        
                                                        </td>
                                                        </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                                <!-- END Intro -->

                                <!-- Footer -->
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">

                                    <tr>
                                        <td class="p30-15 bbrr" style="padding: 10px 30px 10px 30px ; border-radius:0px 0px 26px 26px;" bgcolor="#f9dc06">
                                            <table width="100%" border="0" cellspacing="0" cellpadding="0">


                                                <tr>
                                                    <td class="text-footer2" style="color:#ffffff; font-family:'Muli', Arial,sans-serif; font-size:12px; line-height:26px; text-align:center;"> 
                                                    {{ date("Y") }} &copy; WE UNITE 91 Team.</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                                <!-- END Footer -->
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
</html>
