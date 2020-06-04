<!DOCTYPE html>
<html>
<head>
	<title>Receipt</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    
    <style style type="text/css" media="all">
    .contact-form .formtitle {
	font: 700 21px/19px 'Montserrat';
	padding: 0 0 20px 0;
	/*text-align: center;*/
}
.contact-form {
	margin: 5px auto;
	outline: none;
	box-shadow: 1px 1px 5px 3px rgba(0, 0, 0, 0.08);
	font: 400 13px/28px 'Roboto', sans-serif;
	color: #666;
	padding: 5px 5px 5px 5px;
	/*text-align: center;*/
	max-width: 98%;
    background: #fff;
    border : 1px solid rgba(0, 0, 0, 0.08);
}
.contact-form label {
	text-align: left;
	display: block;
	font: 700 11px/19px 'Montserrat';
	text-transform: uppercase;
    letter-spacing: 1px;
    
}
.inline-input {
	display: inline-block;
	vertical-align: top;
	width: 45%;
	min-width: 270px;
	margin: 10px;
	position: relative;
}

					
.signature img {width:300px !important;							
    height:70px !important;			
}						

.pdfprint td{
    
    line-height: 2 !important; 
}


.logo img {
 width:200px !important;
 height:70px !important;
}


.logosave img {
    max-width:200px !important;
   max-height:70px !important;
    padding-top:3px !important;
    padding-bottom:3px !important;
    padding-left:3px !important;
    padding-left:5px !important;
   }

        .clear {
            clear: both;
          }



.moneytext
{
    text-align:right !important;
    padding-right:2px !important;
}
.middletext
{
    text-align:center !important;
    padding-right:2px !important;
}

.child-left { background: #0ff; }
.child-right { background: #ff0; }

.divprintleft {
    display:inline-block;
    width:60%;
    white-space:normal;
    vertical-align:top;
}
.divprintright {
    display:inline-block;
    width:40%;
    white-space:normal;
    vertical-align:top;
}


.heademiddlediv
                {
                    float:left !important;width:520px;text-align:center !important;padding-top:5px;
                    font-family:verdana; display:inline-block !important;vertical-align:middle !important;
                    padding:20px 4px 0px 4px 
                }
                .headertext
                {
                    text-align: center;font:bold 24px verdana !important;font-size:25px !important;
                    line-height:20px !important;margin-left:10px !important;color:#400040 !important;
                    padding-top:5px; border-bottom:2px solid gray;padding-bottom:4px;
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
                    float:left;width:250px !important;padding-top:10px !important;display:inline-block !important;
                    overflow:vertical;
                }
                .mainParent {
   
    width:98%;
    height: 150px;
    overflow:hidden;
    zoom:1;
    border : 1px solid rgba(0, 0, 0, 0.08);
    
}
                .mainParent .mainchild {
    
    padding-top: 10px;
    float: left;
    padding-left: 20px;
    padding-right: 20px;
    position:relative;
   
    display:inline-block;
}
html { margin-left: 2%;
margin-right:0px !important}

.maindata>div
{
    margin-top:5px;
}
    </style>
</head>
<body >
<div class="mainParent contact-form" style="margin-bottom:0px !important">
    <div class="mainchild" style="width:20% !important">
                <img style="width:100% !important;height:100px !important;" 
                    src="https://www.weunite91.com/public/frontend/image/united-91.jpg" 
                    class="img img-responsive">
    </div>
    <div class="mainchild"  style="width:41% !important" >
    <span class="headertext">We Unite 91</span><br>
           
            <br>
    </div>
    <div class="mainchild" style="width:30% !important" >
        <div>
                
                 weunite91.com<br>
                www.weunite91.com
                
            </div>
    </div>
</div>

<div class="contact-form" style="width:98% !important;margin-top:0px !important">
<div style="width:100%;text-align:center;font-weight:bold;font-size:25px;margin-top:10px">{{$invoice->invoice_header_name}}</div>

<div style="margin-left:10px;margin-top:10px" class="maindata">
<div style="width:50%;float:left">
Customer Billing Address: <br>
{{$invoice->txn_no}} ,<br>
{{$invoice->txn_no}},<br>
{{$invoice->txn_no}},<br>
{{$invoice->txn_no}} -{{$invoice->txn_no}}.
</div>
<div style="width:50%;float:left">
GSTIN NO: {{$invoice->txn_no}}<br>
Transaction No. : {{$invoice->txn_no}}<br>
Invoice No:{{$invoice->invoice_no}}<br>
    Invoice Date:{{$invoice->invoice_dt}}<br>
    Invoice Amount:{{$invoice->grand_total}}
</div>
<div style="clear:both"></div>
<div style="margin-top:10px;width:100%">
@php
    if ($invoice->sgst_amt >0)
    $display_gst=$invoice->gst/2;
    else
    $display_gst=$invoice->gst;

    $display_gst='@ '.$display_gst.'%';
@endphp
    <table border="1" cellspacing="0" style="width:100%;padding:0px 0px 0px 0px;border-color:lightgrey">
        <thead>
            <tr>
            <th>SR.No.</th>
            <th>Product Name</th>
            <th>HSN Code</th>
            <th>Qty</th>
            <th>UOM</th>
            <th>Unit Price</th>
            <th>Taxable Value</th>
            @if ($invoice->sgst_amt >0)
            <th>CGST</th>
            <th>SGST</th>
            @else
            <th>IGST</th>
            @endif
            <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="middletext">1</td>
                <td class="middletext">{{$invoice->product_name}}</td>
                <td class="middletext">{{$invoice->hsn_code}}</td>
                <td class="middletext">1</td>
                <td class="middletext">NOS</td>
                <td class="moneytext">{{$invoice->taxable_amt}}</td>
                <td class="moneytext">{{$invoice->taxable_amt}}</td>
                @if ($invoice->sgst_amt >0)
                <td class="moneytext">{{$invoice->sgst_amt}} <br> {{$display_gst}}</td>
                <td class="moneytext">{{$invoice->cgst_amt}} <br> {{$display_gst}}</td>
                @else
                <td class="moneytext">{{$invoice->igst_amt}} <br> {{$display_gst}}</td>
                @endif
                <td class="moneytext">{{$invoice->grand_total}}</td>
            </tr>
        </tbody>
    </table>
</div>



<div style="margin-top:15px">
    <div>For,</div>
    <div>We Unite 91</div>
    <div>Crew</div>
</div>



</div>

</div>



</body>
</html>