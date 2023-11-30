<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\fabric;
use App\Models\partie;
use App\Models\Roll;
use App\Models\linkRoll;
use App\Models\LinkFabricLot;
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
        try {
            $data = new fabric;
            $id = IdGenerator::generate(['table' =>'fabrics','field'=>'fabricId', 'length' => 10, 'prefix' =>'FABR-']);
            $data->fabricId = $id;
            $data->fabricName = $req->fabricName;
            $data->fabricColor = $req->fabricColor;
            $data->meter = $req->meter;
            $minusRoll = Roll::where('rollId', $req->rollId)->first();
            $minusRoll->remainingQuantity -= $req->meter;
            $minusRoll->save();
            $data->rate = $req->rate;
            $data->rollId = $req->rollId;
            $data->rolls = count($req->rollData);
            $data->remainingMeter = $req->meter;
            $data->fabricBaar = $req->fabricBaar;
            $data->description = $req->description;
        
            foreach($req->rollData as $rolls){
                $insertData = new LinkFabricLot;
                $insertData->fabricId = $id;
                $insertData->rollId = $req->rollId;
                $insertData->rollSubId = $rolls;
                $insertData->roleQuantity = getSubRollQuantity($rolls);
                $insertData->rollUseStatus = 1;
                $insertData->save();
            }
            $data->status = 0;
        
            if($data->save()){
                Alert::success('Success', 'Fabric Added Successfully');
            }
            return redirect('fabrics');
        } catch (QueryException $e) {
            Log::error($e->getMessage());
            Alert::error('Error', 'There was an error adding fabric. Please try again.');
            return redirect()->back();
        }
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
            $data->remainingQuantity = $request->totalRollQuantity;
            $data->gatePass = $request->gatePass;
            $data->biltyNo = $request->biltyNo;
            $data->date = $request->date;
            $data->driverName = $request->driverName;
            $data->dcNumber = $request->dcNumber;
            $data->noOfRolls = $request->noOfRolls;
            $data->createdBy = $request->created_by;
        
            if ($data->save()) {
                $num = count($request->squantity);
                for ($i = 0; $i < $num; $i++) {
                    $roll = new linkRoll;
                    $roll->rollId = $id;
                    $roll->rollSubId = $id.'-'.$request->rollSubId[$i];
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
    public function updateRollData(Request $request){
        try {
            DB::beginTransaction(); // Start a database transaction
            
            $data = Roll::where('rollId',$request->rollId)->first();
            $data->partieId = $request->partie_id;
            $data->rollRate = $request->rollRate;
            $data->rollTotalMeter = $request->rollTotalMeter;
            $data->totalRollQuantity = $request->totalRollQuantity;
            $data->totalAmount = $request->totalAmount;
            $data->remainingQuantity = $request->remainingQuantity;
            $data->gatePass = $request->gatePass;
            $data->biltyNo = $request->biltyNo;
            $data->date = $request->date;
            $data->driverName = $request->driverName;
            $data->dcNumber = $request->dcNumber;
            $data->noOfRolls = $request->noOfRolls;
            $data->createdBy = $request->created_by;
        
            if ($data->save()) {
                $num = count($request->squantity);
                $rollData = linkRoll::where('rollId',$request->rollId)->get();
                $rollData->each->delete();
                for ($i = 0; $i < $num; $i++) {
                    $roll = new linkRoll;
                    $roll->rollId = $request->rollId;
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
        }       
    }
    public function addFabricLot(){
        $fabricRoll = Roll::where('remainingQuantity','>',0)->get();
        // dd($fabricRoll);
        return view('dashboard.fabrics.addFabricLot',compact('fabricRoll'));
    }
    public function getRollIdData($id){
        $rollData = linkRoll::where('rollId',$id)->where('rollUseStatus',0)->get();
        return response()->json($rollData);
    }
    public function getFabricLotQuantity($id){
        $data = fabric::where('fabricId',$id)->first();
        return response()->json($data->remainingMeter);
    }
}