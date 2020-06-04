<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Silder extends Model {

    //
    protected $table = "slider";

    public function getSilderlist() {
        $requestData = $_REQUEST;
        $columns = array(
            // datatable column index  => database column name
            0 => 'slider.id',
            1 => 'slider.image',
            2 => 'users.firstname',
            3 => 'users.lastname',
        );

        $query = Silder::from('slider')
                ->join("users","users.id","=","slider.addedby")
                ->orderBy('slider.created_at', 'DESC');


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
        // print_r($requestData);exit;
        $temp = $query->orderBy($columns[$requestData['order'][0]['column']], $requestData['order'][0]['dir']);

        $totalData = count($temp->get());
        $totalFiltered = count($temp->get());

        $resultArr = $query->skip($requestData['start'])
                        ->take($requestData['length'])
                        ->select('slider.id', 'slider.image',"users.firstname","users.lastname")
                        ->get();
        $data = array();

        $i = 0;
        foreach ($resultArr as $row) {
            $i++;
            $imagepath = url("public/upload/slider/" . $row['image']);
            $actionhtml = '<center><button class="btn btn-danger btn-xs deleteslider" data-toggle="modal" data-target="#deleteModel" data-image="' . $row['image'] . '" data-id="' . $row['id'] . '">
                             <i class="fa fa-trash-o"></i>
                         </button></center>';
            $nestedData = array();
            $nestedData[] = '<center>' . $i . '</center>';
            $nestedData[] = '<center><img height="90px" width="180px" src="' . $imagepath . '" style="margin:20px;"></center>';
            $nestedData[] = '<center>' .$row['firstname'].' '.$row['lastname']. '</center>';
            $nestedData[] = $actionhtml;
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
    
    public function addSlider($request,$userid) {
        
        if($request->file()){
            $objSlider = new Silder();
            $image = $request->file('slider');
            $name = 'slider'.time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/upload/slider/');
            $image->move($destinationPath, $name);    
            $objSlider->image = $name;
            $objSlider->addedby = $userid;
            $objSlider->created_at = date("Y-m-d h:i:s");
            $objSlider->updated_at = date("Y-m-d h:i:s");
            return $objSlider->save();
        }else{
            return false;
        }
    }
    
    
    public function deleteslider($data){
        $path = 'public/upload/slider/' . $data['image'];
        if (file_exists($path)) {
            unlink($path);
        }
        return $result = Silder ::where('id', $data['id'])
                        ->delete();
        
    }
    
    public function slider() {
        return Silder::select("image")->get();
    }
}
