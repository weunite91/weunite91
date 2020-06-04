<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class All_paymentModel extends Model
{
   	protected $table = 'all_payments';

   	public function getallpaymentlist(){
        $requestData = $_REQUEST;
        $columns = array(
            // datatable column index  => database column name
            0 => 'u1.firstname',
            1 => 'iro.profile_code',
            2 => 'iro.paid_amount',
            3 => 'iro.transaction_id'
        );

        $query = Investor_proposal::from('all_payments as iro')
                                ->leftjoin('users as u1','u1.id','=','iro.user_id')
                                ->orderBy('iro.created_at','DESC');
        if (!empty($requestData['search']['value'])) {
            // if there is a search parameter, $requestData['search']['value'] contains search parameter
            $searchVal = $requestData['search']['value'];
            $query->where(function($query) use ($columns, $searchVal, $requestData) {
                $flag = 0;
                foreach ($columns as $key => $value) {
                    $searchVal = $requestData['search']['value'];
                    if ($requestData['columns'][$key]['searchable'] == 'true') {
                        if ($flag == 0) {
                            $query->where($value, 'like', '%' . $searchVal . '%');
                            $flag = $flag + 1;
                        } else {
                            $query->orWhere($value, 'like', '%' . $searchVal . '%');
                        }
                    }
                }
            });
        }
        
        $temp = $query->orderBy($columns[$requestData['order'][0]['column']], $requestData['order'][0]['dir']);

        $totalData = count($temp->get());
        $totalFiltered = count($temp->get());

        $resultArr = $query->skip($requestData['start'])
                        ->take($requestData['length'])
                        ->select('iro.profile_code','iro.transaction_id','iro.paid_amount','iro.paid_for','u1.firstname','u1.lastname','iro.created_at')->get();
        $data = array();
                // echo "<pre>";print_r($resultArr);exit;
        $i = 0;
       
        foreach ($resultArr as $row) {
           $i++;
           
            
                   
            $nestedData = array(); 
            $nestedData[] = '<center>'.$i.'</center>';        
            $nestedData[] = '<center>'.$row["firstname"].' '.$row["lastname"].'</center>';
            $nestedData[] = '<center>'.$row["profile_code"].'</center>';
            $nestedData[] = '<center>'.$row["transaction_id"].'</center>';
            $nestedData[] = '<center>'.$row["paid_amount"].'</center>';
            $nestedData[] = '<center>'.$row["paid_for"].'</center>';
            $nestedData[] = '<center>'.date("d-m-Y H:s:i A", strtotime($row["created_at"])).'</center>';
            
            $data[] = $nestedData;
        }
        //echo "<pre>";print_r($data);exit;

        $json_data = array(
            "draw" => intval($requestData['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
            "recordsTotal" => intval($totalData), // total number of records
            "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data" => $data   // total data array
        );
          return $json_data;
    }
}
