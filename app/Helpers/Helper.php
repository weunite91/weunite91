<?php
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
$paging_key="zdf193";
function dec_enc($action, $string) {
	$output = false;
 
	$encrypt_method = "AES-256-CBC";
	$secret_key = 'jac@467';
	$secret_iv = '632@153sf';
 
	// hash
	$key = hash('sha256', $secret_key);
	
	// iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
	$iv = substr(hash('sha256', $secret_iv), 0, 16);
 
	if( $action == 'encrypt' ) {
		$output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
		$output = base64_encode($output);
	}
	else if( $action == 'decrypt' ){
		$output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
	}
 
	return $output;
}
function encrypt_pageno($pageno)
{
	//$encrypted = Crypt::encrypt($pageno);
	$encrypted = dec_enc('encrypt', $pageno);
	return $encrypted;
}
function decrypt_pageno($pageno)
{
	$encrypted = dec_enc('decrypt', $pageno);
	return $encrypted;
}
function get_current_page_no($request,$page_size,&$current_page,&$start_page)
{
	
	$page_size=9;
	$total_records=0;
   if ( $request->input('pagetype') ==null)
   {
		$current_page=1;
   }
   else{
		$de_current_page=$request->input('pagetype');
		$current_page=decrypt_pageno($de_current_page);
   }
   $start_page=($current_page-1)*$page_size+1;
   $start_page--;
}
function get_total_pages($page_size,$total_records,&$data,$current_page)
{
	//echo "<br/>Total Records:".$total_records;

    $data['is_prev_page_disabled']=0;
    $data['is_next_page_disabled']=0;
    if ($current_page==1)
    {
            $data['is_prev_page_disabled']=1;
    }
    $total_pages = (int)($total_records/$page_size);
    $remainder=$total_records%$page_size;
    if ($remainder>0)
    {
        $total_pages++;
    }
    if ($current_page==$total_pages)
    {
            $data['is_next_page_disabled']=1;
    }
    $data['prev_page']=encrypt_pageno($current_page-1);
    $data['next_page']=encrypt_pageno($current_page+1);
}
 
if (!function_exists('indian_money_format')) {
    /**
     * Returns a human readable file size
     *
     * @param integer $bytes
     * Bytes contains the size of the bytes to convert
     *
     * @param integer $decimals
     * Number of decimal places to be returned
     *
     * @return string a string in human readable format
     *
     * */
    function indian_money_format($num)
    {
        if ($num==null)
		{
			return "0.00";
		}
		$isNegative=false;
	   //$num= round($num,$this->m_round_Up_decimals);
	   $nums = explode ( ".", $num );
	   if (count ( $nums ) > 2) {
		   return "0";
	   } else {

		   if ($num<0)
		   {
			   $isNegative=true;
			  $num=$num*-1;
			  $nums = explode ( ".", $num );
		   }
		   if (count ( $nums ) == 1) {
			   $nums [1] = "00";
		   }
		   $num = $nums [0];
		   $explrestunits = "";
		   
		   
		   if (strlen ( $num ) > 3) {
			   $lastthree = substr ( $num, strlen ( $num ) - 3, strlen ( $num ) );
			   $restunits = substr ( $num, 0, strlen ( $num ) - 3 );
			   $restunits = (strlen ( $restunits ) % 2 == 1) ? "0" . $restunits : $restunits;
			   $expunit = str_split ( $restunits, 2 );
			   for($i = 0; $i < sizeof ( $expunit ); $i ++) {
				   
				   if ($i == 0) {
					   $explrestunits .= ( int ) $expunit [$i] . ",";
				   } else {
					   $explrestunits .= $expunit [$i] . ",";
				   }
			   }
			   $thecash = $explrestunits . $lastthree;
		   } else {
			   $thecash = $num;
		   }
		  if (strlen ( $nums [1]) == 1)
		  {
			$nums [1]= $nums [1]."0"; 
          }
          if ($nums [1]=='00')
          {
            $final=$thecash;
          }
          else{
            $final=$thecash . "." . $nums [1];
          }
         
          if ($isNegative==true)
          {
               
              $final="-".$final;
          }
          
          return $final;
	   }
 
    }
}
 
?>