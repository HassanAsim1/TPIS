<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\fabric;
use App\Models\partie;
use App\Models\Roll;
use App\Models\linkRoll;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\DB;
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
    public function fabricDetail($id){
        $data = fabric::where('fabric_id',$id)->first();
        return view('dashboard.fabrics.fabricDetail',compact('data'));
    }
    public function addRoll(){
        $partie = partie::where('category', 'seller')->get();
        return view('dashboard.Roll.addRoll',compact('partie'));
    }
    public function addRollData(Request $request){
        try {
            DB::beginTransaction(); // Start a database transaction
            
            $data = new Roll;
            $id = IdGenerator::generate(['table' => 'rolls', 'field' => 'rollId', 'length' => 10, 'prefix' => 'ROLL-']);
            $data->rollId = $id;
            $data->partieId = $request->partie_id;
            $data->rollRate = $request->rollRate;
            $data->rollTotalMeter = $request->rollTotalMeter;
            $data->totalRollQuantity = $request->totalRollQuantity;
            $data->totalAmount = $request->totalAmount;
            $data->remainingQuantity = $request->remainingQuantity;
            $data->createdBy = $request->created_by;
        
            if ($data->save()) {
                $num = count($request->squantity);
                for ($i = 0; $i < $num; $i++) {
                    $roll = new linkRoll;
                    $roll->rollId = $id;
                    $roll->rollSubId = $request->rollSubId[$i];
                    $roll->rollDescription = $request->sdes[$i];
                    $roll->rollQuantity = $request->squantity[$i];
                    $roll->rollRate = $request->srate[$i];
                    $roll->rollUseStatus = 0;
                    $roll->rollTotalRate = $request->stotal[$i];
                    $roll->createdBy = session('role');
                    $roll->save();
                }
        
                DB::commit(); // Commit the transaction if everything is successful
                Alert::success('Success', 'Roll Details Added Successfully');
                return redirect()->back();
            } else {
                DB::rollBack(); // Rollback the transaction if $data->save() fails
                Alert::error('Error', 'Failed to add Roll Details');
            }
        } catch (Exception $e) {
            DB::rollBack(); // Rollback the transaction on any exception
            Alert::error('Error', $e->getMessage());
        } finally {
            return redirect()->back();
        }        
    }
    public function viewRoll(){
        $data = Roll::all();
        return view('dashboard.Roll.viewRoll',compact('data'));
    }
    public function editRoll($id){
        $roll = Roll::where('rollId',$id)->first();
        $rollData = linkRoll::where('rollId',$id)->get();
        $partie = partie::where('category','seller')->get();

        return view('dashboard.Roll.editRoll',compact('roll','rollData','partie'));
    }
}