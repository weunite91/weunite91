@include ('emails.email-header')
                                <!-- Intro -->
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff" style="padding-top: 30px">
    <tr>
        <td style="padding-bottom: 10px;">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td class="p30-15" style="padding: 10px 30px;">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td class="text-center pb25 textfont" >
                                        Hi {{ $data['firstname']." ".$data['lastname']}},
                                </td>
                            </tr>
                            <tr>
                                <td class="pb25 textfont" >
                                    We are Glad to host you..
                                </td>
                            </tr>
                            <tr>
                                <td class="pb25 textfont" >
                                    Your one time password (OTP) is 
                                    <span style="font-size:40px;vertical-align:middle;padding-bottom:5px">
                                    {{ $data['otp'] }}
                                    </span>.
                                </td>
                            </tr>
                            <tr>
                                <td class="pb25 textfont" >
                                    If you have not logged in with this email Id, kindly report to info@weunite91.com
                                </td>
                            </tr>
                            <tr>
                                <td class="pb25 textfont signature" >
                                Thank you,<br/>
                                WE UNITE 91<br/>
                                Security<br/>
                                </td>
                        </tr>
                        <tr>
                            <td class="pb25 disclaimer">
                            Disclaimer: We Unite 91 is a platform for connecting business sell sides with investors, buyers, lenders and advisors and this email has
                        been sent on behalf of such members. We Unite 91 neither represents nor guarantees that the information is complete or correct. This
                        email message and its content are intended solely for the originally intended addressee(s) and may be legally privileged and
                        confidential. If you have received this email by error, please delete it and contact the sender immediately. You should not copy or
                        forward it or otherwise use the contents, attachments, or information in any way without the permission of the sender. Any such
                        unauthorized use or disclosure may be unlawful.
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

@include ('emails.email-footer')

                              
