<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\fabric;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Alert;

class fabricController extends Controller
{
    //
    public function fabrics(){
        $data = fabric::all();
       return view("dashboard.fabrics",['data'=>$data]);
   }

    public function add_fabric(Request $req){
        $data = new fabric;
        $id = IdGenerator::generate(['table' =>'fabrics','field'=>'fabric_id', 'length' => 10, 'prefix' =>'FABR-']);
        $data->fabric_id = $id;
        $data->fabric_name = $req->fabricname;
        $data->fabric_type = $req->fabrictype;
        $data->meter = $req->meter;
        $data->rate = $req->rate;
        $data->remaining_meter = $req->meter;
        $data->customer_name = $req->customername;
        $data->status = $req->status;

        if($data->save()){
            Alert::success('Success', 'Fabric Added Successfully');
        }

        return redirect('fabrics');
    }
}