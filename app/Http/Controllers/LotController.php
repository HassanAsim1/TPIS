<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;
use App\Models\lot;
use App\Models\register;
use App\Models\shirtlot;
use App\Models\linkshirtlot;
use App\Models\linklotcard;
use App\Models\lotcard;
use App\Models\parties_ledger;
use App\Models\employee_ledger;
use App\Models\linkinvoice;
use App\Models\partie;
use App\Models\fabric;
use App\Models\invoice;
use App\Models\kadhilot;
use App\Models\Removelot;
use Haruncpi\LaravelIdGenerator\IdGenerator;
// use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;
use Exception;


class LotController extends Controller
{
    public function PantLot(){
        $data = lot::orderBy('lot_id','DESC')->get();
        $master = register::where('role','master')->get();
        $mstatus = register::where('email',session('email'))->first();
        return view('lot.pantlot',['data'=>$data],['master'=>$master])->with('mstatus',$mstatus);
    }
    public function Add_Pant_Lot(Request $req){
        // dd($req);
        // dd(number_format((float)$req->cost_price, 2, '.', ''));
        $data = new lot;
        $id = IdGenerator::generate(['table' =>'lots','field'=>'lot_id', 'length' => 10, 'prefix' =>'PANT-']);
        $data->lot_id = $id;
        $data->lot_name = $req->name;
        $data->lot_quantity = $req->quantity;
        $data->lot_remain = $req->remain_quantity;
        $data->lot_size = json_encode($req->size);
        $data->lot_master = $req->master;
        $data->damage_pcs = $req->damage;
        $data->lot_cm = $req->cm;
        $data->fabric_id = $req->fabricid;
        $data->fcost = $req->fcost;
        $data->mcost = $req->muratary;
        $data->beltclip = $req->beltclip;
        if($req->has('rib') == 'on'){
            $data->rib = 1;
        }
        else{
            $data->rib = 0;
        }
        if($req->has('kadi') == 'on'){
            $data->kadi = 1;
        }
        else{
            $data->kadi = 0;
        }
        if($req->has('outoffactory') == 'on'){
            $data->outoffactory = 1;
        }
        else{
            $data->outoffactory = 0;
        }
        $data->cost_price = number_format((float)$req->cost_price, 2, '.', '');
        $data->sale_price = $req->sale_price;
        $data->status = 1;

        if($data->save()){
            Alert::success('Success', 'Lot Added Successfully');
        }
        // return redirect(route('pant_lot'));
        return redirect()->back();

    }
    public function TrackPantLot(){
        $data = lot::all();
        // dd($data->lot_id);
        return view('lot.TrackPantLot',['data'=>$data]);
    }
    public function LotCard(){
        $data = register::where('user_id',session('user_id'))->first();
        $emp_data = register::all();
        if(session('working_area') == 1)
        {
            $lotdata = lot::where('status','>=',2)->get();
            $CheckLot = array();
            for($i = 0; $i<count($lotdata); $i++){
                $checkData = linklotcard::where('user_id',session('user_id'))
                ->where('lot_id',$lotdata[$i]['lot_id'])
                ->where('role','=',session('role'))->first();
                if($checkData == null){
                    if(!linklotcard::where('lot_id',$lotdata[$i]['lot_id'])
                    ->where('role','=',session('role'))->exists()){
                        array_push($CheckLot,$lotdata[$i]);
                    }
                }
            }
        }
        else if(session('working_area') == 2)
        {
            $lotdata = lot::where('status','>=',3)->where('kadi',1)->get();
            $CheckLot = array();
            for($i = 0; $i<count($lotdata); $i++){
                $checkData = linklotcard::where('user_id',session('user_id'))
                ->where('lot_id',$lotdata[$i]['lot_id'])
                ->where('role','=',session('role'))->first();
                if($checkData == null){
                    if(!linklotcard::where('lot_id',$lotdata[$i]['lot_id'])
                    ->where('role','=',session('role'))->exists()){
                        array_push($CheckLot,$lotdata[$i]);
                    }
                }
            }
        }
        else if(session('working_area') == 3)
        {
            $lotdata = lot::where('status','>=',4)->get();
            $CheckLot = array();
            for($i = 0; $i<count($lotdata); $i++){
                $checkData = linklotcard::where('user_id',session('user_id'))
                ->where('lot_id',$lotdata[$i]['lot_id'])
                ->where('role','=',session('role'))->first();
                if($checkData == null){
                    if(!linklotcard::where('lot_id',$lotdata[$i]['lot_id'])
                    ->where('role','=',session('role'))->exists()){
                        array_push($CheckLot,$lotdata[$i]);
                    }
                }
            }
        }
        else if(session('working_area') == 4)
        {
            $lotdata = lot::where('status','>=',5)->get();
            $CheckLot = array();
            for($i = 0; $i<count($lotdata); $i++){
                $checkData = linklotcard::where('user_id',session('user_id'))
                ->where('lot_id',$lotdata[$i]['lot_id'])
                ->where('role','=',session('role'))->first();
                if($checkData == null){
                    if(!linklotcard::where('lot_id',$lotdata[$i]['lot_id'])
                    ->where('role','=','master')->exists()){
                        array_push($CheckLot,$lotdata[$i]);
                    }
                }
            }
        }
        else if(session('working_area') == 5)
        {
            $lotdata = lot::where('status','>=',6)->get();
            $CheckLot = array();
            for($i = 0; $i<count($lotdata); $i++){
                $checkData = linklotcard::where('user_id',session('user_id'))
                ->where('lot_id',$lotdata[$i]['lot_id'])
                ->where('role','=',session('role'))->first();
                if($checkData == null){
                    if(!linklotcard::where('lot_id',$lotdata[$i]['lot_id'])
                    ->where('role','=',session('role'))->exists()){
                        array_push($CheckLot,$lotdata[$i]);
                    }
                }
            }
        }
        else if(session('working_area') == 6)
        {
            $lotdata = lot::where('status','>=',7)->get();
            $CheckLot = array();
            for($i = 0; $i<count($lotdata); $i++){
                $checkData = linklotcard::where('user_id',session('user_id'))
                ->where('lot_id',$lotdata[$i]['lot_id'])
                ->where('role','=',session('role'))->first();
                if($checkData == null){
                    if(!linklotcard::where('lot_id',$lotdata[$i]['lot_id'])
                    ->where('role','=',session('role'))->exists()){
                        array_push($CheckLot,$lotdata[$i]);
                    }
                }
            }
        }
        else if(session('working_area') == 8)
        {
            // dd('hi');
            $lotdata = lot::where('status','>=',9)->get();
            $CheckLot = array();
            for($i = 0; $i<count($lotdata); $i++){
                $checkData = linklotcard::where('user_id',session('user_id'))
                ->where('lot_id',$lotdata[$i]['lot_id'])
                ->where('role','=',session('role'))->first();
                if($checkData == null){
                    if(!linklotcard::where('lot_id',$lotdata[$i]['lot_id'])
                    ->where('role','=',session('role'))->exists()){
                        array_push($CheckLot,$lotdata[$i]);
                    }
                    // dd($checkData);
                    // dd($CheckLot);
                }
            }
        }
        else if(session('working_area') == 9)
        {
            // dd('hi');
            $lotdata = lot::where('status','>=',10)->get();
            $CheckLot = array();
            for($i = 0; $i<count($lotdata); $i++){
                $checkData = linklotcard::where('user_id',session('user_id'))
                ->where('lot_id',$lotdata[$i]['lot_id'])
                ->where('role','=',session('role'))->first();
                if($checkData == null){
                    if(!linklotcard::where('lot_id',$lotdata[$i]['lot_id'])
                    ->where('role','=',session('role'))->exists()){
                        array_push($CheckLot,$lotdata[$i]);
                    }
                    // dd($checkData);
                    // dd($CheckLot);
                }
            }
        }
        else if(session('working_area') == 10)
        {
            // dd('hi');
            $lotdata = lot::where('status','>=',11)->get();
            $CheckLot = array();
            for($i = 0; $i<count($lotdata); $i++){
                $checkData = linklotcard::where('user_id',session('user_id'))
                ->where('lot_id',$lotdata[$i]['lot_id'])
                ->where('role','=',session('role'))->first();
                if($checkData == null){
                    if(!linklotcard::where('lot_id',$lotdata[$i]['lot_id'])
                    ->where('role','=',session('role'))->exists()){
                        array_push($CheckLot,$lotdata[$i]);
                    }
                    // dd($checkData);
                    // dd($CheckLot);
                }
            }
        }
        else if(session('working_area') == 11)
        {
            // dd('hi');
            $lotdata = lot::where('status','>=',12)->get();
            $CheckLot = array();
            for($i = 0; $i<count($lotdata); $i++){
                $checkData = linklotcard::where('user_id',session('user_id'))
                ->where('lot_id',$lotdata[$i]['lot_id'])
                ->where('role','=',session('role'))->first();
                if($checkData == null){
                    if(!linklotcard::where('lot_id',$lotdata[$i]['lot_id'])
                    ->where('role','=',session('role'))->exists()){
                        array_push($CheckLot,$lotdata[$i]);
                    }
                    // dd($checkData);
                    // dd($CheckLot);
                }
            }
        }
        else if(session('working_area') == 12)
        {
            // dd('hi');
            $lotdata = lot::where('status','>=',12)->get();
            $CheckLot = array();
            for($i = 0; $i<count($lotdata); $i++){
                $checkData = linklotcard::where('user_id',session('user_id'))
                ->where('lot_id',$lotdata[$i]['lot_id'])
                ->where('role','=',session('role'))->first();
                if($checkData == null){
                    if(!linklotcard::where('lot_id',$lotdata[$i]['lot_id'])
                    ->where('role','=',session('role'))->exists()){
                        array_push($CheckLot,$lotdata[$i]);
                    }
                    // dd($checkData);
                    // dd($CheckLot);
                }
            }
        }
        else{
            $CheckLot = array();
        }
        $mstatus = register::where('email',session('email'))->first();
        return view('employeesection.lotcard',compact('data','CheckLot','emp_data'))->with('mstatus',$mstatus);
    }
    // ------------------------ SHIRT LOT -------------------------

    public function ShirtLot(){

        $data = shirtlot::all();
        $mstatus = register::where('email',session('email'))->first();
        return view('lot.shirtlot',['data'=>$data, 'mstatus'=>$mstatus]);
    }
    public function addshirt(){
        $id = IdGenerator::generate(['table' =>'shirtlots','field'=>'lot_id', 'length' => 10, 'prefix' =>'SHIRT-']);
        $master = register::where('role','master')->get();
        return view('lot.addshirt',compact('id'))->with('master',$master);

    }

    public function InsertShirtLot(Request $req){
            $data = new shirtlot;
            $data->lot_id = $req->lot_id;
            $data->lot_fabric = $req->shirt_fabric;
            $data->lot_master = $req->lot_master;
            $data->lot_quantity = $req->lot_quantity;
            $data->lot_remain = $req->lot_quantity;
            $data->damage_pcs = 0;
            $data->cost_price = 0;
            $data->sale_price = 0;
            $data->lot_size = 0;
            $data->status = 'Active';

            $num = count($req->squantity);
            for($i=0; $i<$num; $i++){
                $InData = new linkshirtlot;
                $InData->lot_id = $req->lot_id;
                $InData->lot_color = "images/path";
                $InData->lot_quantity = $req->squantity[$i];
                $InData->lot_size = $req->size[$i];
                $InData->save();
            }
            if($data->save()){
                Alert::success('Success', 'Shirt-Lot Added Successfully');

            }
           // return view('lot.shitrtlot',['data'=>$data]);
            return redirect()->back();
     }
     public function bill_inv(){
        $data = partie::where('category','buyer')->get();
        $fabric = fabric::where('remainingMeter','>',0)->get();
        $id = IdGenerator::generate(['table' =>'invoices','field'=>'invoice_id', 'length' => 10, 'prefix' =>'INV-']);
        $lotdata = lot::where('status',13)->where('lot_remain','>',0)->get();
        return view('invoice.bill_invoice',compact('id','lotdata','fabric'))->with('data',$data);
     }
     public function InsertInvoice(Request $req){
        try {
            // Start a database transaction
            DB::beginTransaction();
        
            $data = new invoice;
            $data->invoice_id = $req->invoice_id;
            $data->partie_id = $req->partie_id;
            $data->bill_type = $req->bill_type;
            $data->total_pcs = $req->total_quantity;
            $data->grand_total = $req->grandtotal;
            $data->discount = 0;
            $data->created_by = $req->created_by;
        
            // Save the main invoice data
            $num = count($req->squantity);
        
            // Save the linked invoice data
            for ($i = 0; $i < $num; $i++) {
                $InData = new linkinvoice;
                $InData->invoice_id = $req->invoice_id;
                $InData->lot_id = $req->slot[$i];
                if($req->bill_type == 'Fabric Bill'){
                    $minusFabric = fabric::where('fabricId',$req->slot[$i])->first();
                    if($minusFabric){
                        $minusFabric->remainingMeter -= $req->squantity[$i];
                        $minusFabric->save();
                    }
                }
                $InData->description = $req->sdes[$i];
                $InData->quantity = $req->squantity[$i];
                $InData->rate = $req->srate[$i];
                $InData->total = $req->stotal[$i];
                $InData->save();
            }
        
            // For Credit in Parties Ledger
            $config = ['table' => 'parties_ledgers', 'field' => 'payment_id', 'length' => 12, 'prefix' => 'PRTYPAY-'];
            $pid = IdGenerator::generate($config);
        
            $partie = new parties_ledger;
            $partie->payment_id = $pid;
            $partie->parties_id = $req->partie_id;
            $partie->trans_id = $req->invoice_id;
            $partie->description = $req->bill_type;
            $partie->credit = $req->grandtotal;
            $partie->given_by = session('user_id');
            $partie->save();

            $data->slipId = $pid;
            $data->save();
        
            // Update Partie Current balance
            $partieData = partie::where('partie_id', $req->partie_id)->first();
            $partieData->current_balance = $partieData->current_balance + $req->grandtotal;
            $partieData->save();
        
            // Commit the transaction if everything is successful
            DB::commit();
        
            session()->put('invoiceNumber', $data->invoice_id);
        
            return redirect()->back()->with('success', $data->invoice_id . ' Has Successfully Inserted');
        } catch (Exception $e) {
            // An error occurred, rollback the transaction
            DB::rollBack();
        
            return redirect()->back()->with('error', 'Error, ' . $e->getMessage());
        }
     }

     public function ViewInvoice(Request $req){
        $data = invoice::all();
        return view('invoice.view_invoice',['data'=>$data]);
    }


    public function ViewInvDetail($id){
        $Invdata = invoice::where('invoice_id',$id)->first();
        $data = linkinvoice::where('invoice_id',$id)->get();
        // dd($data);
        return view('invoice.view_detail_invoice',compact('data','Invdata'));
    }
    public function InsertPantLot(Request $req){
        try {
            DB::beginTransaction(); // Start a database transaction
        
            $data = new lotcard;
            $id = IdGenerator::generate(['table' => 'lotcards', 'field' => 'card_id', 'length' => 10, 'prefix' => 'CARD-']);
            $data->card_id = $id;
            $data->user_id = $req->user_id;
            $data->card_type = $req->card_type;
            $data->fix_rate = $req->fix_rate;
            $data->working_area = $req->working_area;
            $data->total_pcs = $req->total_quantity;
            $data->grand_total = $req->grandtotal;
            $data->verify_card = 0;
        
            if ($data->save()) {
                $num = count($req->squantity);
        
                for ($i = 0; $i < $num; $i++) {
                    $lot_id = $req->sname[$i];
                    $workingArea = $req->working_area;
        
                    if (session('role') != 'shirt') {
                        $existingRecord = linklotcard::where('lot_id', $lot_id.'-'.session('user_id'))
                            ->where('role', $workingArea)
                            ->where('status', 1)
                            ->first();
        
                        if ($existingRecord) {
                            $removeLot = new Removelot;
                            $removeLot->card_id = $id;
                            $removeLot->user_id = $req->user_id;
                            $removeLot->lot_id = $lot_id.'-'.session('user_id');
                            $removeLot->description = $req->sdes[$i];
                            $removeLot->quantity = $req->squantity[$i];
                            $removeLot->rate = $req->srate[$i];
                            $removeLot->role = $workingArea;
                            $removeLot->total = $req->stotal[$i];
                            $removeLot->verify_lot = 0;
                            $removeLot->check_by = 'system';
                            $removeLot->save();
                            continue;
                        }
                    }
        
                    $InData = new linklotcard;
                    $InData->card_id = $id;
                    $InData->user_id = $req->user_id;
                    $InData->lot_id = $lot_id.'-'.session('user_id');
                    $InData->description = $req->sdes[$i];
                    $InData->quantity = $req->squantity[$i];
                    $InData->rate = $req->srate[$i];
                    $InData->role = $workingArea;
                    $InData->total = $req->stotal[$i];
                    $InData->save();
                }
        
                DB::commit(); // Commit the transaction if everything is successful
                Alert::success('Success', 'Lot-Card Added Successfully');
            } else {
                DB::rollBack(); // Rollback the transaction if $data->save() fails
                Alert::error('Error', 'Failed to add Lot-Card');
            }
        } catch (Exception $e) {
            DB::rollBack(); // Rollback the transaction on any exception
            Alert::error('Error', $e->getMessage());
        } finally {
            return redirect()->back();
        }        
    }

            // Verify Lot Cards

    public function CardVerify(){
        $data = lotcard::where('verify_card',0)->get();
        $mstatus = register::where('email',session('email'))->first();
        return view('lot.verify_card',['data'=>$data])->with('mstatus',$mstatus);
    }

    public function CardVerifyID($id){
        $data = lotcard::where('card_id',$id)->first();
        $CardData = linklotcard::where('card_id',$data->card_id)->get();
        return view('lot.verify_card_id',compact(('data')))->with('CardData',$CardData);
    }
    public function EditPantLot($id){
        $data = lot::where('lot_id',$id)->first();
        $mstatus = register::where('email',session('email'))->first();
        $FabData = fabric::where('remaining_meter','>',0)->get();
        // dd($data);
        return view('lot.editpantlot')->with('data',$data)->with('mstatus',$mstatus)->with('FabData',$FabData);
    }
    public function VerifyCardAdmin(Request $req){
        $data = lotcard::where('card_id', $req->card_id)->first();
        if ($data) {
            $lotdata = linklotcard::where('card_id', $data->card_id)->get();
            $lotdata->each->delete();
            $data->total_pcs = $req->total_quantity;
            $data->grand_total = $req->grandtotal;
            $data->working_area = $req->working_area;
            $data->verify_card = 1;
            $num = count($req->squantity);

            for ($i = 0; $i < $num; $i++) {
                $lot_id = $req->sname[$i];
                $workingArea = $req->working_area;

                    // Check if a record with the same lot_id, role, and status = 1 already exists in the database
                    $existingRecord = linklotcard::where('lot_id', $lot_id)
                    ->where('role', $workingArea)
                    ->where('status', 1)
                    ->first();

                    if ($existingRecord) {
                        $removeLot = new Removelot;
                        $removeLot->card_id = $id;
                        $removeLot->user_id = $req->user_id;
                        $removeLot->lot_id = $lot_id.'-'.session('user_id');
                        $removeLot->description = $req->sdes[$i];
                        $removeLot->quantity = $req->squantity[$i];
                        $removeLot->rate = $req->srate[$i];
                        $removeLot->role = $workingArea;
                        $removeLot->total = $req->stotal[$i];
                        $removeLot->verify_lot = 0;
                        $removeLot->check_by = 'system';
                        $removeLot->save();
                        continue;
                    }

                $InData = new linklotcard;
                $InData->card_id = $req->card_id;
                $InData->user_id = $req->user_id;
                $InData->lot_id = $lot_id;
                $InData->description = $req->sdes[$i];
                $InData->quantity = $req->squantity[$i];
                $InData->rate = $req->srate[$i];
                $InData->status = 1;
                $InData->role = $workingArea;
                $InData->total = $req->stotal[$i];
                $InData->save();
            }

            $EmpData = new employee_ledger;
            $config = ['table' => 'employee_ledgers', 'field' => 'payment_id', 'length' => 12, 'prefix' => 'EMPPAY-'];
            $Pid = IdGenerator::generate($config);
            $EmpData->payment_id = $Pid;
            $EmpData->employee_id = $req->user_id;
            $EmpData->description = 'Credit By ' . session('name') . ' Pcs: ' . $req->total_quantity;
            $EmpData->debit = $req->debit;
            $EmpData->credit = $req->grandtotal;
            $EmpData->given_by = $req->given_by;
            $EmpData->save();

            if ($data->save()) {
                Alert::success('Success', 'Lot-Card Updated Successfully');
            }
        } else {
            Alert::success('Error', 'Lot-Card Not Found');
        }

        return redirect()->back();

    }
    public function KadhiLot(){
        $data = lot::where('kadi',1)->get();
        return view('lot.kadhilot')->with('data',$data);
    }
    public function addkadhilot($id){
        $data = lot::where('lot_id',$id)->first();
        $lot = KadhiLot::where('lot_id',$id)->first();
        return view('lot.addkadhilot',compact('data','lot'));
    }
    public function addkadhilotdetails(Request $request){
        $lotcheck = KadhiLot::where('lot_id',$request->lot_id)->first();
        if($lotcheck){
            $data = $lotcheck;
            // if($request->hasFile('front_image') && $lotcheck->front_image != ''){
            //     Storage::delete(asset('public/attachments/'.$lotcheck->front_image));
            // }
        }
        else{
            $data = new KadhiLot;
        }
        $data->lot_id = $request->lot_id;
        $data->lot_quantity = $request->lot_quantity;
        if($request->hasFile('front_image')){
            $file = $request->file('front_image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move('public/attachments', $fileName);
            $data->front_image = $fileName;
        }
        if($request->hasFile('back_image')){
            $file = $request->file('back_image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move('public/attachments', $fileName);
            $data->back_image = $fileName;
        }
        $data->back_stich = $request->back_stich;
        $data->front_stich = $request->front_stich;
        $data->total_front_amount = $request->front_amount;
        $data->total_back_amount = $request->back_amount;
        $data->total_amount = $request->total_amount;
        $data->save();


        if(checklotcard($request->lot_id)){
            createlotcard($request->all());
        }

        return redirect()->back()->with('success', 'Lot Updated successfully.');


    }
    public function Next($id){
        $data = lot::where('lot_id',$id)->first();
        $inc = $data->status;
        $inc++;
        $data->status = $inc;
        session()->put('msg', $id . ' Lot Status ' . $data->status . ' Updated');
        $data->save();
        return 'success';
    }
    public function Back($id){
        $data = lot::where('lot_id',$id)->first();
        $inc = $data->status;
        $inc--;
        $data->status = $inc;
        session()->put('msg', $id . ' Lot Status ' . $data->status . ' Updated');
        $data->save();
        return 'success';
    }
    public function ViewLotDetail($id){
        $data = lot::where('lot_id',$id)->first();
        return view('lot.viewlot',compact('data'));
    }
    public function show_verify_card(){
        if(session('role') == 'admin' || session('role') == 'manager'){
            $data = lotcard::where('verify_card',1)->get();
            $mstatus = register::where('email',session('email'))->first();
            return view('lot.verifycard.verify_card',['data'=>$data])->with('mstatus',$mstatus);
        }
        else{
            $data = lotcard::where('verify_card',1)->where('user_id', session('user_id'))->get();
            $mstatus = register::where('email',session('email'))->first();
            return view('lot.verifycard.verify_card',['data'=>$data])->with('mstatus',$mstatus);
        }
    }
    public function show_verify_card_by_id($id){
        $data = lotcard::where('card_id',$id)->first();
        $CardData = linklotcard::where('card_id',$data->card_id)->get();
        return view('lot.verifycard.verify_card_id',compact(('data')))->with('CardData',$CardData);
    }
    public function delete_verify_card($id){
        $data = lotcard::where('card_id',$id)->first();
        $lotdata = linklotcard::where('card_id',$id)->get();
        $lotdata->each->delete();
        $data->delete();

        return redirect()->back()->with('success', 'Lot Deleted Successfully');
    }
    public function invoiceEdit($id){
        $invoiceId = invoice::where('invoice_id',$id)->first();
        $invoiceIdData = linkinvoice::where('invoice_id',$id)->get();
        $data = partie::all();
        return view('invoice.invoiceEdit.invoiceEdit',compact('invoiceId', 'invoiceIdData','data'));
    }
    public function updateInvoice(Request $request){
        try {
            // Start a database transaction
            DB::beginTransaction();
        
            $data = invoice::where('invoice_id', $request->invoice_id)->first();
            $data->invoice_id = $request->invoice_id;
            $data->partie_id = $request->partie_id;
            $data->bill_type = $request->bill_type;
            $data->total_pcs = $request->total_quantity;
            $data->grand_total = $request->grandtotal;
            $data->discount = 0;
            $data->created_by = $request->created_by;
        
            // Save the main invoice data
            $data->save();
        
            // Delete existing linked invoice data
            $invoiceData = linkinvoice::where('invoice_id', $request->invoice_id)->get();
            $invoiceData->each->delete();
        
            // Save the new linked invoice data
            $num = count($request->squantity);
            for ($i = 0; $i < $num; $i++) {
                $InData = new linkinvoice;
                $InData->invoice_id = $request->invoice_id;
                $InData->lot_id = $request->slot[$i];
                $InData->description = $request->sdes[$i];
                $InData->quantity = $request->squantity[$i];
                $InData->rate = $request->srate[$i];
                $InData->total = $request->stotal[$i];
                $InData->save();
            }
        
            // For Credit in Parties Ledger
            $partie = parties_ledger::where('payment_id', $data->slipId)->first();
            $partie->parties_id = $request->partie_id;
            $partie->trans_id = $request->invoice_id;
            $partie->description = $request->bill_type;
            $partie->credit = $request->grandtotal;
            $partie->given_by = session('user_id');
            $partie->save();
        
            // Update Partie Current balance
            $partieData = partie::where('partie_id', $request->partie_id)->first();
            $partieData->current_balance = $partieData->current_balance + $request->grandtotal;
            $partieData->save();
        
            // Commit the transaction if everything is successful
            DB::commit();
        
            session()->put('invoiceNumber', $data->invoice_id);
        
            return redirect()->back()->with('success', $data->invoice_id . ' Has Successfully Updated');
        } catch (Exception $e) {
            // An error occurred, rollback the transaction
            DB::rollBack();
        
            return redirect()->back()->with('error', 'Error, ' . $e->getMessage());
        }
    }
    public function checkLot(Request $request){
        $user = register::whereNotIn('role', ['admin', 'cashier'])->get();
        $lotQuery = linklotcard::query();
        if(isset($request->getLot)) {
            $lotQuery->where('lot_id', 'LIKE', "%$request->getLot%");
        }
        if(isset($request->userId)) {
            $lotQuery->where('user_id', $request->userId);
        }
        if(isset($request->role)) {
            $lotQuery->where('role', $request->role);
        }
        if(isset($request->getLot) || isset($request->userId) || isset($request->role)) {
            $lot = $lotQuery->get();
            $lotSum = $lot->sum('quantity');
        } else {
            $lot = linklotcard::all();
            $lotSum = $lot->sum('quantity');
        }
        return view('lot.verification.checkLot', compact('lot', 'lotSum', 'user'));
    }
    public function removeLot(){
        $data = removeLot::all();
        $mstatus = register::where('email',session('email'))->first();
        return view('lot.verification.removeLot',compact('data','mstatus'));
    }
    public function disableEmployees(){
        $employees = register::where('role', '!=', 'admin')
                            ->where('role', '!=', 'cashier')
                            ->where('role', '!=', 'manager')
                            ->get();
        
        foreach ($employees as $employee) {
            $employee->loginStatus = 0;
            $employee->save();
        }
        session()->put('loginStatus','Disable');
        return redirect()->back();
    }
    public function activeEmployees(){
        $employees = register::where('role', '!=', 'admin')
                            ->where('role', '!=', 'cashier')
                            ->where('role', '!=', 'manager')
                            ->get();
        
        foreach ($employees as $employee) {
            $employee->loginStatus = 1;
            $employee->save();
        }
        session()->put('loginStatus','Active');
        return redirect()->back();
    }
}
