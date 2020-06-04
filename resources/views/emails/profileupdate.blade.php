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
                                You have successfully registered your profile with We Unite 91.

                                </td>
                            </tr>
                            <tr>
                                <td class="pb25 textfont" >
                                Your registered profile is under process and will be Active in ~2 business working days.

                                </td>
                            </tr>
                            <tr>
                                <td class="pb25 textfont" >
                                If your Profile is not Active within the specified time, kindly get back to us on
info@weunite91.com so that we can prioritize the same.
                                </td>
                            </tr>

                            <tr>
                                <td class="pb25 textfont" >
                                By putting an effort to mark our email ID to trustworthy source, you will not miss out
on some very important communications/offers from us.

                                </td>
                            </tr>
                            <tr>
                                <td class="pb25 textfont" >
                                In case of any queries, kindly email or submit your query on our website.

                                </td>
                            </tr>
                            <tr>
                                <td class="pb25 textfont signature" >
                                Thanks and with best regards,<br/>
                                WE UNITE 91<br/>
                                Crew<br/>
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

                              
