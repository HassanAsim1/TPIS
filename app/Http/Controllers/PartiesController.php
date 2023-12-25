<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\register;
use App\Models\partie;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Alert;

class PartiesController extends Controller
{
    //

      public function parties(){
        $data = partie::all();
       return view("parties.parties",['data'=>$data]);
   }
    public function add_parties(Request $req){
        $data = new partie;
        $id = IdGenerator::generate(['table' =>'parties','field'=>'partie_id', 'length' => 10, 'prefix' =>'PRTY-']);
        $data->partie_id = $id;
        $data->name = $req->name;
        $data->address = $req->address;
        $data->phone_no = $req->phone_no;
        $data->opening_balance = $req->openbalance; 
        $data->current_balance = $req->currentbalance;
        $data->category = $req->category;
        $data->status = $req->status;
        if($data->save()){
            Alert::success('Success', 'Partie Added Successfully');
        }
        // return redirect(route('pant_lot'));
     //   return view("parties.parties");
        return redirect(route('partie'));

    }

    public function EditParties($id){
        $data = partie::where('partie_id',$id)->first();
        return view('parties.editparty',compact('data'));
    }

    public function update(Request $req)
     {  
        $data = partie::where('partie_id',$req->partie_id)->first();
        $data->address = $req->address;
        $data->name = $req->name;
        $data->opening_balance = $req->opening_balance;
        $data->current_balance = $req->current_balance;
        $data->phone_no = $req->phone_no;
        $data->category = $req->category;
        $data->status = $req->status;
       if ($data->save()){
        Alert::success('Success', 'Partie Edit Successfully');
       }

        return redirect(route('partie'));
     }
     public function partie_detail($id){
        $data = partie::where('partie_id',$id)->first();
        return $data;
     }
}
