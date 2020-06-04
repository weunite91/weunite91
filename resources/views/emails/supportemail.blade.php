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
                                    Hello Request for KPI Support ...
                                </td>
                            </tr>
                            <tr>
                                <td class="pb25 textfont" >
                                    Name : {{ $data['name'] }}
                                </td>
                            </tr>
                            <tr>
                                <td class="pb25 textfont" >
                                    Profile Code : {{ $data['profileCode'] }}
                                </td>
                            </tr>
                            <tr>
                                <td class="pb25 textfont" >
                                    Email :{{ $data['email'] }}
                                </td>
                            </tr>
                            <tr>
                                <td class="pb25 textfont" >
                                    Number :{{ $data['number'] }}
                                </td>
                            </tr>
                            <tr>
                                <td class="pb25 textfont" >
                                    Message :{{ $data['msg'] }}
                                </td>
                            </tr>
                            <tr>
                                <td class="pb25 textfont signature" >
                                    Thank you,<br/>
                                </td>
                            </tr>
                            
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
@include ('emails.email-footer')

