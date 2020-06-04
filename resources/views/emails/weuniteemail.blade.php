@include ('emails.email-header')
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
                                                            <td class="text-center pb25 textfont" style="font-size:18px !important" >
                                                            Congratulations!
                                                         </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="pb25 textfont" >
                                                              We are delighted to host you in our dais 
                                                              <a class="urlanchor" href="https://weunite91.com" target="_blank">WE UNITE 91</a>
                                                              , your profile has 
                                                              cleared the
                                                                milestones of our due diligence, and it is 
                                                                <a class="urlanchor" href="https://weunite91.com" target="_blank">
                                                                ACTIVE</a> now.
                                                                </td>
                                                                <tr>
                                                                <td class="pb25 textfont">
                                                                We have specially created a email id for you and the same email ID will be shared
                                                                with the other registered profiles/members of <a class="urlanchor" href="https://weunite91.com" target="_blank">WE UNITE 91</a>.
                                                                                                                                </td>
                                                            </tr>
                                                            

                                                            <tr>
                                                                <td class="pb25 textfont" >
                                                                <div style="width:100px;float:left">Email</div>
                                                                <div style="float:left"> 
                                                                <a  class="urlanchor" href="https://weunite91.com:2096/login/?user={{ $data['weunite91mail'] }}" target="_blank" >
                                                                 {{ $data['weunite91mail'] }}
                                                                 </a>
                                                                 </div>
                                                                <br/>
                                                                <div style="width:100px;float:left">Password</div>
                                                                <div style="float:left">{{ $data['weunite91mail_pwd'] }}</div>

                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="pb25 textfont" style="font-size:18px; font-weight:bold !important" >
                                                                How to Use / Login
                                                                </td>
                                                            </tr>
                                                           
                                                            <tr>
                                                                <td class="text-center pb25 textfont" >
                                                                1. Go to <a class="urlanchor"  href="https://weunite91.com:2096/login/?user={{ $data['weunite91mail'] }}" target="_blank" >https://weunite91.com/webmail</a><br/>
                                                                2. Enter your email id and your password<br/>
                                                                3. Select Round Cube (as a default), suggested 
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="pb25 textfont" style="font-size:18px; font-weight:bold !important" >
                                                                How to change password
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="pb25 textfont">
                                                                <img  src="https://www.weunite91.com/public/frontend/image/welcomekit_mail_change.png" border="0" alt="" />
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="pb25 textfont">
                                                            For any further doubt or clarification please feel free to contact us
                                                                at info@weunite91.com
                                                                </td>
                                                                </tr>
                                                                <tr>
                                                                <td class="pb25 textfont" style="text-align:center !important;">
                                                                <hr style="width:400px !important"/>
                                                                </td>
                                                                </tr>

                                                            <tr>
                                                                <td class="pb25 textfont"  >
                                                                You have agreed to all of our following <b>TERMS OF ENGAGEMENT AND
                                                                    CONDITIONS</b>. You are advised not to use our website 
                                                                    <a class="urlanchor" href="https://weunite91.com" target="_blank">
                                                                    www.weunite91.com</a> if you do
                                                                    not agree any of our terms of use, and inform us at 
                                                                    <a class="urlanchor" href="mailto:info@weunite91.com" >
                                                                    info@weunite91.com</a>.
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="pb25 textfont" style="font-size:18px; font-weight:bold !important" >
                                                                Confidential/Contract/Terms Of Use
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="pb25 textfont"  >
                                                                Below mentioned Standard Terms of Use “Terms” apply in respect of all the activities
carried out by We Unite 91 except to the extent that they otherwise agree/s with the
Registered Member in writing.
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="pb25 textfont"  >
                                                                1.That all the information provided by the Registered Member or on behalf, is true and
complete to the best of your knowledge.

                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="pb25 textfont"  >
                                                                2. That the Registered Member agrees not to post, email, display, upload, modify,
publish, transmit, update or share any information on our website, or otherwise make
available content that violates any law or regulations or that is false/bogus, misleading
or deceitful.
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="pb25 textfont"  >
                                                                            3. That the authorized team members of
                                                                            <span class="weunite91"> We Unite 91</span> may seek proof of the content or
                                                                            information shared by the Registered Member at any time. The Registered Member
                                                                            agrees to furnish relevant proof of the claims made by it within 3 working days of the
                                                                            request made by  <span class="weunite91"> We Unite 91</span>. If the said proof is not submitted within the prescribed
                                                                            time,  <span class="weunite91"> We Unite 91</span> shall be at the liberty to not approve such profile or shall be entitled
                                                                            to either delete such information it believes to be false or suspend the said profile. 
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="pb25 textfont"  >
                                                                4. That the Registered Member agree to promptly disclose in absolute good faith the
                                                                    correct transaction value and transaction closure date and other material terms to
                                                                    We Unite 91 by promptly sending an email to 
                                                                    <a class="urlanchor" href="mailto:info@weunite91.com" >
                                                                    info@weunite91.com
                                                                    </a> 
                                                                    within 2 working
                                                                    days of transaction closure to enable  <span class="weunite91"> We Unite 91</span> to raise an invoice. 
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="pb25 textfont"  >
                                                                5. That any form of financial transaction between the Registered Member and the
                                                                business listed with  <span class="weunite91"> We Unite 91</span> including investment, complete buyout, sale of
                                                                shares, sales of any asset is considered as a successful transaction from which
                                                                We Unite 91 finder’s fee would be applicable. 
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="pb25 textfont"  >
                                                                6. That the transaction shall be deemed closed on the date on which the Registered
Member and the business listed on  <span class="weunite91"> We Unite 91</span> sign the final version of the definitive
agreement. Amongst themselves or on the receipt of any payment pertaining to the
transaction by the business from the Registered Member, whichever is earliest.
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="pb25 textfont"  >
                                                                7. That the failure to disclose accordingly in good faith within the aforesaid time-frame
would entitle We Unite 91 to be indemnified to an amount that is not less than 1% of
the total transaction value or INR 25,000 (Rupees Twenty Five Thousand only) or
USD 350 (United States Dollar Three Hundred and Fifty only), whichever is higher.
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="pb25 textfont"  >
                                                                8. That the total transaction value includes a total payment made committed future
pay-outs, non-cash payments, debt assumed by acquirer and bonus payments to be
paid to the management. 
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="pb25 textfont"  >
                                                                9. That the Registered Member shall use the information received from the business
and  <span class="weunite91"> We Unite 91</span> only for evaluation of the transaction in question and not for any
other purpose. Further, the Registered Member shall not disclose, directly or indirectly,
any such information received, including contact information, to any person other than
his representatives who are directly participating in the evaluation of this transaction.
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="pb25 textfont"  >
                                                                10. That the Registered Member is aware that  <span class="weunite91"> We Unite 91</span> has access to all of his/her
communication with other member introduced to him/her through We Unite 91, in
order to ensure a smooth transaction between the Registered Member and other
members, based on the content of the communication between these parties,
We Unite 91, reserves the right to take any action as stated in terms and conditions.
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="pb25 textfont"  >
                                                                11. That  <span class="weunite91"> We Unite 91</span> will hold in confidence all information concerning the Registered
Member or his affairs that is acquired during the course of acting for the Registered
Member.  <span class="weunite91"> We Unite 91</span> will not disclose any of this information to any other person
except,<br/>
a) To the extent necessary or desirable to enable  <span class="weunite91"> We Unite 91</span> to carry out the
Registered Member instructionsand/or<br/>
b) To the extent required by law/relevant authorized government bodies.
Notwithstanding the aforesaid, use consents to  <span class="weunite91"> We Unite 91</span> using the user’s company
name and logo on it’s website, promotional material or other literature/write-ups
unless the user requests otherwise. 
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="pb25 textfont"  >
                                                                12. That the Registered Member understands that  <span class="weunite91"> We Unite 91</span> does not provide any
representation or warranty as to completeness or accuracy of any information received
from a business. The Registered Member are responsible for the accuracy and
content of the listings.
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="pb25 textfont"  >
                                                                13. That in addition to the extent permitted by law,  <span class="weunite91"> We Unite 91</span> is not liable, and the
Registered Member agrees not to hold them responsible, for any damages or losses,
including but not limited to loss of consequential damages, resulting directly or
indirectly from the use of their services.
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="pb25 textfont"  >
                                                                14. That if the Registered Member has a dispute with one or more other Registered
Member, that Registered Member release  <span class="weunite91"> We Unite 91</span> from claims, demands and
damages, actual and consequential of every kind and nature, known and unknown,
arising out of or in any way connected with such disputes. 
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="pb25 textfont"  >
                                                                15. That the Registered Member will indemnify and hold  <span class="weunite91"> We Unite 91</span> harmless from
and against any and all claims, damages, obligation, losses, liabilities, costs or debt
and expenses, including but not limited to legal fees, arising from the Registered
Member use of and access to the Website and/ or the service violation of any of the
terms of these Terms, claims made by any third party due to or arising out of the
Registered Member breach of this Agreement, improper use of  <span class="weunite91"> We Unite 91</span> services
or breach of any law or the rights of a third party. This defense, duty of confidentiality
and indemnification obligations will survive termination, modification or expiration of
these Terms and your use of the Service and the Website. 
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="pb25 textfont"  >
                                                                16. That, although the Registered Member may expect to be reimbursed by a third
party for  <span class="weunite91"> We Unite 91</span> fees and expenses and although the invoice may at the request
of the Registered Member or with his/her approval be directed to a third party
nevertheless the Registered Member remains responsible for payment to  <span class="weunite91"> We Unite 91</span>
of the third party fails to pay them. 
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="pb25 textfont"  >
                                                                17. That the Registered Member agrees and consents to receive Phone Calls, SMS
and Emails that  <span class="weunite91"> We Unite 91</span> sends in connection with his/her account at We Untie 91.

                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="pb25 textfont"  >
                                                                18. That the Registered Member agrees that  <span class="weunite91"> We Unite 91</span> can use its best efforts to
advertise, market and promote his/her requirements on various platforms and social
media in order to maximize the introductions he/she receives. 
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="pb25 textfont"  >
                                                                19. That the Registered Member acknowledges and agrees that  <span class="weunite91"> We Unite 91</span> may
establish limits from time-to-time concerning use of the Services, including among
others, the maximum numbers of days that content will be maintained or retained by
the Service, that maximum number and size of postings, emails messages, or other
content that may be transmitted or stored by the Service, and the frequency with
which the Registered Member may access the Service or the Website.

                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="pb25 textfont"  >
                                                                20. That the Registered Member grants permission to  <span class="weunite91"> We Unite 91</span> to publish the
successful deal closure on its website upon intimating the transaction closure date to
it and the publication may be done for any purposes of trade, advertising, publicity or
promotion. The Registered Member hereby releases  <span class="weunite91"> We Unite 91</span> from liability
resulting from or attributable to any of the actions authorized above.
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="pb25 textfont"  >
                                                                21. That the Registered Member acknowledges and agrees that  <span class="weunite91"> We Unite 91</span> has no
responsibility or liability for the deletion or failure to store any Content maintained or
transmitted by the Website or the Service. 
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="pb25 textfont"  >
                                                                22. That If, <span class="weunite91"> We Unite 91</span> believes that the Registered Member is abusing We Unite 91
in any way or if the Registered Member intentionally furnishes information or makes
claims knowing it to be false or deliberately fails to furnish verification proof to back
its claims or fails to pay the Finder's Fee to  <span class="weunite91"> We Unite 91</span> within the allotted time,
<span class="weunite91"> We Unite 91</span> may, in their sole discretion and without limiting other remedies, limit,
suspend, or terminate the user account(s) and access to their Services, delay or
remove hosted content, remove any special status associated with the user's
account(s) and take technical and/or legal steps to prevent the User from using the
Services. On such an action being taken by  <span class="weunite91"> We Unite 91</span>,  <span class="weunite91"> We Unite 91</span> shall also be
entitled to retain the entire fees paid to it by the Registered Member, towards
damages. The Registered Member shall not be entitled to seek a refund of the same.
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="pb25 textfont"  >
                                                                23.That  <span class="weunite91"> We Unite 91</span> is not liable for any infringement of intellectual property rights
arising out of materials posted on or transmitted through the site, or items advertised
on the site, by end-users or any other third parties.
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="pb25 textfont"  >
                                                                24. That, In the event of any dispute of any nature whatsoever, whether in any court
or otherwise, the liability of  <span class="weunite91"> We Unite 91</span> would be restricted to the fee paid under this
engagement
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="pb25 textfont"  >
                                                                25. That these Terms apply to any current engagement and also to any future
engagement, whether or not  <span class="weunite91"> We Unite 91</span> send another copy to the Registered
Member.  <span class="weunite91"> We Unite 91</span> is entitled to change these Terms from time to time, in which
case they shall send out the amended Terms. 
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="pb25 textfont"  >
                                                                26. That any disputes, differences or questions between the parties arising out of, or
in connection with, these Terms of Use, or the commission of any breach of any terms
thereof or of compensation payable thereof or in any manner whatsoever in
connection with it, shall be decided through Arbitration by a sole arbitrator. The
decision of such an arbitrator shall be final and binding on the parties. The venue of
the arbitration proceedings shall be at Bangalore, India and the provisions of the
Arbitration and Conciliation Act, 1996, shall be applicable to such proceedings. 
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="pb25 textfont"  >
                                                                27. That this engagement shall be governed by and constructed in accordance with
the laws of India. The exclusive venue for all actions related to or arising out of this
engagement shall be the Courts of Bangalore, India.
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="pb25 textfont"  >
                                                                Acceptance of the Terms mentioned herein shall constitute a valid contract that is
binding on the parties.
                                                                </td>
                                                            </tr>
                                                            
                                                            <tr>
                                                                <td class="pb25 textfont signature" >
                                                                Thanking You,<br/>
                                                                
                                                                WE UNITE 91<br/>
                                                                Crew

                                                            </td>
                                                        </tr>

                                                        <tr>
                                                                <td class="pb25 textfont signature" >
                                                              <a href="https://weunite91.com" target="_blank" >www.weunite91.com</a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                                <td class="pb25 textfont signature" >
                                                              Follow us on 
                                                              <a  class="social-links" rel="nofollow" href="https://www.facebook.com/We-Unite-91-102349501325030/?modal=admin_todo_tour" target="_blank">
                            <img src="https://weunite91.com/public/frontend/image/fb.png" alt="facebook">
                            </a>

                            <a class="social-links" rel="nofollow" href="https://twitter.com/91Unite" target="_blank">
                            <img src="https://weunite91.com/public/frontend/image/tw.png" alt="twitter">
                            </a>

                            <a class="social-links" rel="nofollow" href="https://www.google.co.in/" target="_blank">
                            <img src="https://weunite91.com/public/frontend/image/g.png" alt="google">
                        </a>

                        <a class="social-links" rel="nofollow" href="https://www.instagram.com/" target="_blank">
                            <img src="https://weunite91.com/public/frontend/image/i.png" alt="google">
                        </a>

                        <a class="social-links" rel="nofollow" href="https://www.linkedin.com/in/we-unite-nine-one-a008461a0/" target="_blank">
                        <img src="https://weunite91.com/public/frontend/image/in.png" alt="google">
                        </a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="pb25 disclaimer" >
                                                           Disclaimer: We Unite 91 is a platform for connecting business sell sides with investors, buyers, lenders and advisors and this email has been sent on behalf of such
members. We Unite 91 neither represents nor guarantees that the information is complete or correct. This email message and its content are intended solely for the
originally intended addressee(s) and may be legally privileged and confidential. If you have received this email by error, please delete it and contact the sender immediately.
You should not copy or forward it or otherwise use the contents, attachments, or information in any way without the permission of the sender. Any such unauthorized use or
disclosure may be unlawful.
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