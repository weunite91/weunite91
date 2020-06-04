<?php



namespace App\Services;

use Illuminate\Support\Facades\Session;

use App\Model\Invoice;

use App\Model\InvoiceItems;

class Invoicepdf {

    public function save_invoice( $userDetails,$invoice_details,$from,$session )
    {
        $login_user_id=$session['logindata'][0]['id'];
        $objInvoice = new Invoice();
        $objInvoiceItems = new InvoiceItems();



        $this->prepare_invoice($login_user_id,$userDetails,$invoice_details,$from,$session,$objInvoice,$objInvoiceItems);

       

       

        $objInvoice ->save_invoice($objInvoiceItems);



    }

    function prepare_invoice($login_user_id,$userDetails,$invoice_details,$producttype,$session,$objInvoice,$objInvoiceItems)
    {
        if ($producttype=='invester')
        {
            $producttype="Commitment Charges";
            $gst=0;
            $g_table_name='investor_details';
            $invoice_header='Bill';
        }
        else if ($producttype=='fundraiser')
        {
            $gst=18;
            $g_table_name='fund_raise_details';
            $invoice_header='Tax Invoice';
            $producttype=$invoice_details[0]->paid_for;
            $amount=$invoice_details[0]->paid_amount;
            $txnno=$invoice_details[0]->transaction_id;
        }

       
        $this->calculate_gst($objInvoiceItems,$amount,$gst,$userDetails,$objInvoice);
        $objInvoice->customer_id=$login_user_id;
        $objInvoice->invoice_dt=date('Y-m-d h:i');
        $objInvoice->invoice_header_name= $invoice_header;
        $objInvoice->txn_no=$txnno;
        $objInvoice->created_by=$login_user_id;
        $objInvoice->updated_by=$login_user_id;

        $objInvoiceItems->product_name=$producttype;
        $objInvoiceItems->hsn_code='997156';
        $objInvoiceItems->gst=$gst;
        $objInvoiceItems->created_by=$login_user_id;
        $objInvoiceItems->updated_by=$login_user_id;

    }

    function calculate_gst($objInvoiceItems,$amount,$gst,$gst_details,$objInvoice)
    {
        $weunit_country_id=101;
        $weunit_state_id=17;
        $weunit_gst_code='29';
        $taxable_amount=$amount*100/(100+$gst);
        $total_tax=$amount-$taxable_amount;
        $country_id=$gst_details[0]->country;
        $state=$gst_details[0]->state;
        $gst=$gst_details[0]->gst;

        if ($gst==null)
        {
            $gst_code=$weunit_gst_code;
        }
        else
        {
            $gst_code=substr($gst,0,2);
        }

        if ($country_id == $weunit_country_id)
        {
            if ($gst_code==$weunit_gst_code)
            {
                $objInvoiceItems->sgst_amt=$total_tax/2;
                $objInvoiceItems->cgst_amt=$total_tax/2;
            }
            else
            {
                $objInvoiceItems->igst_amt=$total_tax;

            }
        }
        else{
            $objInvoiceItems->igst_amt=$total_tax;
        }

        $objInvoiceItems->taxable_amt=$taxable_amount;

        $objInvoiceItems->grand_total=$amount;

    }

    

    

    function get_css_class()

    {

        $css_html="

                .heademiddlediv

                {

                    float:left !important;width:520px;text-align:center !important;padding-top:5px;

                    fomt-family:verdana; display:inline-block !important;vertical-align:middle !important;

                    padding:20px 4px 0px 4px 

                }

                .headertext

                {

                    text-align: center;font:bold 24px verdana !important;font-size:25px !important;

                    line-height:20px !important;margin-left:10px !important;color:#400040 !important;

                    padding-top:5px; border-bottom:2px solid black;padding-bottom:4px;

                }

                .headercaption

                {

                    font:bold 10px verdana !important;font-size:10px !important;line-height:20px !important;

                    margin-left:5px !important;color:#400040 !important;margin-top:10px !important;display:inline-block;

                }

                .headerbelowaddress

                {

                    font:bold 12px verdana !important;font-size:12px !important;margin-bottom:0px !important;

                    color:#400040 !important;

                }

                .headerlast

                {

                    float:left;width:250px !important;padding-top:10px !important;display:block !important;

                    overflow-vertical;

                }";

            return $css_html;

    }

    function get_invoice_html_header_section()

    {

        $html='';

    }

    function get_header_top_section()

    {

        $header_section=

        '<div class="logosave" style=" z-index:100;float:left !important;max-width:175px !important;

                                            padding-top:10px;padding-left:10px;line-height:10px !important; display:inline-block">

                <img style=" z-index:100;width:170px !important;height:90% !important;" 

                    src="https://www.weunite91.com/public/frontend/image/united-91.jpg" 

                    class="img img-responsive">

        </div>

        <div class="heademiddlediv">

            <span class="headertext">We Unite 91</span><br>

            <span class="headercaption">All KINDS OF MINING | Speciality Chemicals | Wood Based Products,</span>

            <br>

            <span class="headerbelowaddress">19/14/57, RND CROSS RAGHAVENDRA NAGAR, 

                                            Tirupati, Andhra Pradesh, India, 517501 

            </span>

            <br>

        </div>

        <div class="pull-right headerlast" >

            <i class="fa"><img src="http://localhost/taxwoos.com/uploads/logos/phone.png" width="10px;height:10px;"></i> 9676715716<br>

            <i class="fa"><img src="http://localhost/taxwoos.com/uploads/logos/envelope.png" width="10px;height:10px;"></i> nageshcool1979@gmail.com<br>

            <i class="fa"><img src="http://localhost/taxwoos.com/uploads/logos/website.jpg" width="10px;height:10px;"></i> www.dh.com

            <br>

            <span style="word-wrap:break-word !important;display:block;white-space: normal">

            <i class="fa fa-map-marker"></i> 

            <b>Address : </b>abc 123, aaaaaa, Andhra Pradesh, India, 234568

            </span>

            <b style="padding-left:10px;">GSTIN NO : </b>37AAHCC1134B1Z9<br>

        </div>';

        return $header_section;

    }

    function invoice_name_section()

    {

        $html='<div style="color:#08ADCE !important;clear:both !important;float:left !important;

                            width:100% !important;background-color:#F8F8F8 !important;

                            height:40px !important;margin:0px !important;font-size:26px !important;

                            text-align:center;font-weight:bold;">

                    Tax Invoice

                    <div style="clear:both !important;width:100% !important;float:left !important;

                                font-weight:italic;font-size:10px;margin-bottom:2px; !important"> &nbsp; 

                    </div>

                </div>';

        return $html;

    }

    function invoice_main_details()

    {

        $html='<div class="printparent" style="width:100% !important;border-top: 1px solid gray;

                                                 border-bottom: 1px solid gray;">

                <div class="divprintleft" style="width:50% !important;border-right: 1px solid gray;

                                            padding:10px !important;">

                <table class="pdfprint" style="font-weight:bold !important;">

                <tbody>

                <tr>

                <td>GSTIN NO</td>

                <td style="margin-right:20px !important;">: &nbsp;</td>

                <td>37AAHCC1134B1Z9</td>

                </tr>

                <tr>

                <td>Reverse Charge</td>

                <td style="margin-right:20px !important;">: &nbsp;</td>

                <td>No Reverse Charge</td>

                </tr>

                <tr>

                <td>Invoice No</td>

                <td style="margin-right:20px !important;">: &nbsp;</td>

                <td>INV58</td>

                </tr>

                <tr>

                <td>Invoice Date</td>

                <td style="margin-right:20px !important;">: &nbsp;</td>

                <td>19-01-2020</td>

                </tr>

                <tr>

                <td>State</td>

                <td style="margin-right:20px !important;">: &nbsp;</td>

                <td>Andhra Pradesh</td>

                </tr>

                <tr>

                <td>Invoice Amount</td><td>: &nbsp;</td>

                <td>1,428.00</td>

                </tr>

                </tbody>

                </table>

                </div>

                <div class="divprintright" style="width:50% !important;padding:10px !important;">

                <table class="pdfprint" style="font-weight:bold !important;">

                <tbody>

                <tr>

                <td>Place of Supply</td>

                <td style="margin-right:20px !important;">: &nbsp;</td>

                <td>sdf</td>

                </tr>

                <tr>

                <td>Date &amp; Time of Supply</td>

                <td style="margin-right:20px !important;">: &nbsp;</td>

                <td>19-01-2020 00:10:57</td>

                </tr>

                <tr>

                <td>Transporter Name</td>

                <td style="margin-right:20px !important;">: &nbsp;</td>

                <td></td>

                </tr>

                <tr>

                <td>Vehicle No</td>

                <td style="margin-right:20px !important;">: &nbsp;</td>

                <td></td>

                </tr>

                <tr>

                <td>LR / R.R Number</td>

                <td style="margin-right:20px !important;">: &nbsp;</td>

                <td></td>

                </tr>

                <tr>

                <td>Transportation Mode</td>

                <td style="margin-right:20px !important;">: &nbsp;</td>

                <td></td>

                </tr>

                </tbody>

                <tbody></tbody>

                </table>

            </div>

            </div>';

        return $html;

    }

    function get_customer_billing_address()

    {

        $html='<div class="printparent" style="background-color:#D3D3D3 !important;width:100% !important;

                                                border-top: 1px solid gray;border-bottom: 1px solid gray;">

                    <div class="divprintleft" style="width:50% !important;border-right: 1px solid gray;">

                        <div style="float:left  !important;padding:10px 10px 0 10px !important">

                            <p style="font:bold 15px verdana !important;font-size:15px; !important;">Billing To:</p>

                            <p style="font-size:13px !important;line-height:2 !important;">Bank Customer, <br>aaa, <br>sdf,  India - 512345 <br>State Code : 7 - Delhi

                            <br>Ph: 7396651440 GSTIN: 05AAACG0904A1ZL</p>

                        </div> 

                    </div>

                <div class="divprintleft" style="width:50% !important;border-right: 1px solid gray;">

                    <div style="float:left  !important;padding:10px 10px 0 10px !important">

                        <p style="font:bold 15px verdana !important;font-size:15px;">Shipping To:</p>

                        <p style="font-size:13px !important;line-height:2 !important;">

                            Bank Customer, 

                            <br> aaa,<br> sdf, India - 512345<br> State Code : 7 - Delhi

                            <br> Ph: 7396651440 GSTIN: 

                        </p>

                    </div>

                </div>

            </div>';

        return $html;



    }

    function get_invoice_item_details()

    {

        $html='<div style="width:100%  !important; border-right:0px !important;

			                    border-left:0px !important;">

                        <table class="prodtable" border="1">

                        <thead>

                            <tr>

                            <th style="padding:5px 3px !important;color:black;text-align:center;">S.No</th>

                            <th style="padding:5px 3px !important;color:black;text-align:center;">Item Description</th>

                            <th style="padding:5px 3px !important;text-align:center;color:black">HSN Code</th>

                            <th style="padding:5px 3px !important;text-align:center;color:black">Qty</th><th class="textspancolor" style="padding:5px 3px !important;text-align:center;color:black">UOM</th><th class="textspancolor" style="padding:5px 3px !important;text-align:center;color:black">Unit Price</th><th class="textspancolor" style="padding:5px 3px !important;text-align:center;color:black">Taxable Value</th><th class="textspancolor" style="padding:5px 3px !important;text-align:center;color:black">IGST</th><th class="textspancolor" style="padding:5px 3px !important;text-align:center;color:black">CESS</th><th class="textspancolor" style="padding:5px 3px !important;text-align:center;color:black">Total</th></tr>

                        </thead>

                        <tbody class="tbodycus">

                            <tr class="pdftr" role="row">

                                <td rowspan="2" class="textspanitemcolor" style="padding-left:3px; text-align:center;vertical-align:middle">1</td>

                                <td class="textspanitemcolor" style="padding-left:2px !important">up1 Nam123</td>

                                <td class="textspanitemcolor" style="text-align:center">9999</td>

                                <td class="textspanitemcolor moneyitem">2.000</td>

                                <td class="textspanitemcolor" style="text-align:center">BGS</td>

                                <td class="textspanitemcolor moneyitem">200.00</td>

                                <td class="textspanitemcolor moneyitem" rowspan="2">400.00</td>

                                <td class="textspanitemcolor moneyitem" rowspan="2">72.00<br>@ 18%</td>

                                <td class="textspanitemcolor moneyitem" rowspan="2">4.00</td>

                                <td class="textspanitemcolor moneyitem" rowspan="2">476.00</td>

                            </tr>   

                                       

                                    

                            </tbody>

                        </table>

                        </div>';

            return $html;

    }

    function prepare_invoice_html()

    {

        

       $html.='<table style="width:980px;background-color:#ffffff; z-index:100" id="tblFirst">

                <tbody>

                    <tr style="page-break-inside: avoid !important;">

                        <td style="width:100% !important;border:solid 1px gray !important;vertical-align:top !important;">

                            <div class="printparent" style="margin-top:5px !important;">';

        $html.=$this>get_header_top_section();

                                

        $html.=$this>invoice_name_section();

        $html.=$this>invoice_main_details();

        $html.=$this>get_customer_billing_address();

        $html.=$this>get_invoice_item_details();

            

            

        $html.='

                <div style="width:100%  !important;height:5px;background-color:#08ADCE !important;">

                </div>

                <div style="width:100%  !important;height:4px"></div>

                <div style="width:100%  !important; float:left !important; clear:both !important; 

                            border-top:solid 1px #83ddef !important;">

                </div>

                <div class="printparent" style="width:100%  !important; margin-top:10px">

                    <div style="width:60%  !important; float:left !important;clear:both !important;

                                margin-top:5px"><div style="font-size:15px;font-weight:bold;

                                margin-left:1% !important;margin-bottom:5px">

                        Tax Summary :

                    </div>

                    <div style="width:100%  !important; float:left !important; clear:both !important; ></div>

                   

                </div>

                <div style="float:left !important;width:39% !important;margin-right:1% !important;

                                margin-top:5px;line-height:1.8">

                        <div style="padding:0px;font-size:15px;width:100%;text-align:right;"> 

                                Taxable Value : ₹ 1,200.00&nbsp;&nbsp;

                        </div>

                        <div style="padding:0px;font-size:15px;height:28px;width:100%;text-align:right;"> 

                            IGST :  ₹216.00&nbsp;&nbsp;

                        </div>

                        <div style="padding:0px;font-size:15px;width:100%;text-align:right;"> 

                            CESS :  ₹ 12.00&nbsp;&nbsp;

                        </div>

                        <div style="padding:0px;font-size:18px;line-height:34px;text-align:right !important">

                            <b> Grand Total : ₹ 1,428.00</b>&nbsp;&nbsp;

                        </div>

                </div>

                </div>	

            <div class="printparent" style="width:100%;margin-bottom:5px">	

                <div style="width:50%;float:left;display:inline-block;">

                    <div style="float:left !important;width:100% !important;margin-left:1% !important;

                            margin-bottom:4px;line-height:1.6">

                        <b>INVOICE VALUE (IN WORDS) : <br>One Thousand Four Hundred  And Twenty Eight  Rupees </b>

                    </div>

                    <div style="float:left !important;width:100% !important;padding-left:1% !important;

                            margin-bottom:4px;line-height:1.6;border:1px solid gray;border-left:none !important">

                        <span style="font-size:14px;font-weight:bold;">Bank Details : </span>

                        <div>  <b>BANK ACCOUNT NUMBER : </b> 23456</div>

                        <div>   <b>BANK NAME : </b>STATE BANK OF INDIA</div> 

                        <div>  <b>IFSC CODE : </b>SBIN0000678</div>

                    </div>	

                </div>

                <div style="width:50%;float:left;display:inline-block;">

                    <div class="signature" style="padding-right:40px;width:100%;text-align:right;

                                                    font-weight:bold;">

                            For We Unite 91

                    </div>

                    <div class="signature" style="width:100%;text-align:right;padding-right:5px !important">

                        <img src="http://localhost/taxwoos.com/uploads/signs/AY5jdiwali.jpg" class="img img-responsive pull-right">

                    </div>

                    <div style="margin-top:1px !important; font-weight:bold; text-align:right;float:right;width:100%">

                                Authorised Signatory&nbsp;&nbsp;&nbsp;&nbsp;

                    </div>

                </div>

            </div>

            <div style="width:100%  !important;clear:both">&nbsp;</div>

            <div style="width:100%  !important; float:left !important; clear:both !important;height:1px">

                &nbsp;

            </div>

            <div style="width:100% !important;border-top: 1px solid gray;padding-left:4px;margin-top:5px;">

                <p style="margin-top:5px;"><b>TERMS &amp; CONDITIONS</b></p>

                <p>dev test terms and conditions</p>

            </div>

            </div>

            </td>

            </tr>

            <tr>

            <td>&nbsp;</td>

            </tr><

            /tbody>

            </table>';

        

    }

    function prepare_invoice_pdf($file_path,$invoiceNum,$watermarkLogo,$invoiceviewHTML,$viewParam,$business_id,$emailinvoice )

	{

		$pageData .= '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd" />

                    <!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->

                    <!--[if (gte IE 9)|!(IE)]><html lang="en" class="no-js"> <![endif]-->

                    <!--[if IE]> <meta http-equiv="X-UA-Compatible" content="IE=edge"> <![endif]-->

                    <html xml:lang="en-us" xmlns="http://www.w3.org/1999/xhtml">

                    <head>

                        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>

                        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>

                        <meta http-equiv="Content-Type" content="application/json; charset=utf-8"/>

                        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>

                        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>

                        <meta http-equiv="content-Language" content="en"/>

                        <meta name="language" content="en-us"/>

                             <link rel="stylesheet" type="text/css" href="' .url('/')."/" . 'utilities/css/font-awesome.min.css" />

                        <link type="text/css" rel="stylesheet" href="' . url('/')."/" . 'utilities/css/bootstrap.css" />

                        		

                        		

					<style type="text/css">

											

';

$pageData .= '</style>';

if ($watermarkLogo!='')

{

	$pageData .= 

	' <style type="text/css" media="all">

	.watermark-tmp {

		position: relative;

	   

	 }

	 .watermark-tmp:after {

		 content: "";

		 position: absolute;

		 top: 0; right: 0;bottom: 0; left: 0;

		 background: url("'.base_url().'uploads/logos/'.$watermarkLogo.'");

		 background-repeat: repeat-y; 

		 background-position: center center;

		 background-attachment: fixed;

		 background-size:50%;

		 opacity:0.1;

		 z-index:0;

	 } </style>';



	

}







$pageData .= '<script>window.onload = function() { window.status = "onloadready"; }</script>

                      </head>

						<body style="background:#ffffff !important;

						page-break-before:always;margin-top:2px" >';

			

					  $pageData .=$invoiceviewHTML;



		$pageData .= '</body>';

		$pageData .= '</html>';

		$invoicename = 'Triplicate@@Triplicate';

		$inv_no=str_replace(' ','',$invoiceNum);

		$inv_no=str_replace('_','',$inv_no);

		$inv_no=str_replace('/','',$inv_no);

		$inv_no=str_replace('\\','',$inv_no);



		$htmlFilname = 'Invoice_' . $viewParam . '_' . $inv_no . '.html';

		$pdffilename = 'Invoice_' . $viewParam . '_' . $inv_no . '.pdf';

		if($emailinvoice==0)

		{

			$original = str_replace ( $invoicename, 'Original for Customer', $pageData );

			if ($this->m_invoicetypeurl !='quotations')

			{

				$duplicate = str_replace ( $invoicename, 'Duplicate for Transporter', $pageData );

				$triplicate = str_replace ( $invoicename, 'Triplicate for Supplier', $pageData );

			}

			else

			{

				$duplicate="";

				$triplicate="";

			}

			

			$final = $original . $duplicate . $triplicate.$ewaybill_html;

		}

		else

		{

			$original = str_replace ( $invoicename, 'Original', $pageData );

			$final = $original ;

		}

		

		$final=str_replace (  'https://taxwoos.com','file:/home/taxwormo/public_html/taxwoos.com', $final);

		

		$final=str_replace (  'https://devtest.taxwoos.com','file:/home/taxwormo/public_html/devtest.taxwoos.com', $final);

		$htm_folder_path='uploads/htmlfiles/'.$business_id.'/' ;

		$pdf_folder_path='uploads/pdffiles/'.$business_id.'/';

		if ($file_path!='')

		{

			$htm_folder_path=$htm_folder_path.$file_path.'/';

			$pdf_folder_path=$pdf_folder_path.$file_path.'/';

		}

		if (!is_dir($htm_folder_path)) {

			mkdir($htm_folder_path, 0777, TRUE);

		

		}

		if (!is_dir($pdf_folder_path)) {

			mkdir($pdf_folder_path, 0777, TRUE);

		

		}

		

		

		write_file ( FCPATH . $htm_folder_path . $htmlFilname, $final );

	

		$pos = strpos(base_url (),"localhost");

		$dev_pos = strpos(base_url (),"devtest.taxwoos.com");



		if($pos>0)

		{

			$myCmd = FCPATH . "wkhtmltopdf//bin//wkhtmltopdf.exe " 

					. base_url () . "/". $htm_folder_path. $htmlFilname . " " 

					. FCPATH . $pdf_folder_path . $pdffilename . " 2>&1";

			$result = exec ( $myCmd, $output, $var );

		}

		else

		{

			if ($dev_pos>0)

			{

				$myCmd = FCPATH."cgi-bin/wkhtmltox/bin/wkhtmltopdf -T 0 -B 0 -L 0 -R 0 --window-status onloadready /home/taxwormo/public_html/devtest.taxwoos.com/".$htm_folder_path.$htmlFilname   ." ".FCPATH.$pdf_folder_path.$pdffilename." 2>&1";

			

			}

			else

			{

				$myCmd = FCPATH."cgi-bin/wkhtmltox/bin/wkhtmltopdf -T 3 -B 2 -L 3 -R 3 --window-status onloadready /home/taxwormo/public_html/taxwoos.com/".$htm_folder_path.$htmlFilname   ." ".FCPATH.$pdf_folder_path.$pdffilename." 2>&1";

			}

			

			$result = exec($myCmd,$output,$var);

			//	var_dump($output);

			//	exit();

		}

		return $pdffilename;

	}

}

?>