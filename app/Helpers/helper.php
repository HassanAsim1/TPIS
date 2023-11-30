<?php

use App\Models\parties_ledger;
use App\Models\employee_ledger;
use App\Models\linklotcard;
use App\Models\lotcard;
use App\Models\fabric;
use App\Models\invoice;
use App\Models\partie;
use App\Models\cashier_payment;
use App\Models\register;
use App\Models\kadhilot;
use App\Models\linkRoll;
use Carbon\Carbon;
use Haruncpi\LaravelIdGenerator\IdGenerator;

function cal_current_amount($id){
    $data = parties_ledger::where('parties_id',$id)->get();
    $count_debit = 0;
    $count_credit = 0;
    for($i=0; $i<count($data); $i++){
        $count_credit += $data[$i]->credit;
        $count_debit += $data[$i]->debit;
    }
    $total_current_amount = $count_credit - $count_debit;
    return $total_current_amount;
}
function cal_employee_amount($id){
    $data = employee_ledger::where('employee_id',$id)->get();
    $count_debit = 0;
    $count_credit = 0;
    for($i=0; $i<count($data); $i++){
        $count_credit += $data[$i]->credit;
        $count_debit += $data[$i]->debit;
    }
    $total_current_amount = $count_credit - $count_debit;
    return $total_current_amount;
}
function getverifycard(){
    $data = lotcard::where('verify_card',0)->get();
    return count($data);
}

function getpantverify(){
    $data = lotcard::where('verify_card',0)->where('card_type','pant')->get();
    return count($data);
}
function getshirtverify(){
    $data = lotcard::where('verify_card',0)->where('card_type','shirt')->get();
    return count($data);
}
function getfabricrate($id){
    $data = fabric::where('fabric_id',$id)->first();
    if($data == null){
        return 0;
    }
    return $data->rate;
}
function gettotalpcs(){
    $data = number_format(invoice::sum('total_pcs'),0);
    if($data == null){
        return 0;
    }
    return $data;
}
function getpantpcs(){
    $data = number_format(invoice::where('bill_type','pant_bill')->get()->sum('total_pcs'),0);
    if($data == null){
        return 0;
    }
    return $data;
}
function getshirtpcs(){
    $data = number_format(invoice::where('bill_type','shirt_bill')->get()->sum('total_pcs'),0);
    if($data == null){
        return 0;
    }
    return $data;
}
function getpcs(){
    $data = number_format(invoice::sum('total_pcs'),0);
    if($data == null){
        return 0;
    }
    return $data;
}
function gettotalexpense(){
    $partie_debit = parties_ledger::sum('debit');
    $cashier_debit = cashier_payment::where('debit','!=',null)->get()->sum('debit');
    $total_debit = $cashier_debit + $partie_debit;

    return $total_debit;
}
function gettotalcredit(){
    $company_credit = invoice::sum('grand_total');
    $company_credit = cashier_payment::where('user_id','Company')->get()->sum('credit');
    $total_profit = $company_credit + $company_credit;

    return $total_profit;
}
function getprofit(){
    $cashier_debit = cashier_payment::where('debit','!=',null)->get()->sum('debit');
    $company_credit = cashier_payment::where('user_id','Company')->get()->sum('credit');
    $partie_debit = parties_ledger::sum('debit');
    $company_credit = invoice::sum('grand_total');
    $total_credit = $company_credit + $company_credit;
    $total_debit = $cashier_debit + $partie_debit;
    $total_profit = $total_credit - $total_debit;

    return number_format($total_profit);
}
function getprofitmonth(){
    $dateFrom = Carbon::now()->subDays(30);
    $dateTo = Carbon::now();
    $cashier_debit_monthly = cashier_payment::whereBetween('created_at', [$dateFrom, $dateTo])->sum('debit');
    $cashier_credit_monthly = cashier_payment::where('user_id','Expense')->whereBetween('created_at', [$dateFrom, $dateTo])->sum('credit');
    $partie_debit_monthly = parties_ledger::whereBetween('created_at', [$dateFrom, $dateTo])->sum('debit');
    $partie_credit_monthly = invoice::whereBetween('created_at', [$dateFrom, $dateTo])->sum('grand_total');
    $plus_monthly = $cashier_credit_monthly + $partie_credit_monthly;
    $minus_monthly = $cashier_debit_monthly + $partie_debit_monthly;
    $monthly = $plus_monthly - $minus_monthly;
    
    $previousDateFrom = Carbon::now()->subDays(30);;
    $previousDateTo = Carbon::now();
    $cashier_debit_pre_monthly = cashier_payment::whereBetween('created_at', [$previousDateFrom, $previousDateTo])->sum('debit');
    $cashier_credit_pre_monthly = cashier_payment::where('user_id','Company')->whereBetween('created_at', [$previousDateFrom, $previousDateTo])->sum('credit');
    $partie_debit_pre_monthly = parties_ledger::whereBetween('created_at', [$previousDateFrom, $previousDateTo])->sum('debit');
    $partie_credit_pre_monthly = invoice::whereBetween('created_at', [$previousDateFrom, $previousDateTo])->sum('grand_total');
    $plus_pre_monthly = $cashier_credit_pre_monthly + $partie_credit_pre_monthly;
    $minus_pre_monthly = $cashier_debit_pre_monthly + $partie_debit_pre_monthly;
    $previousMonthly = $plus_pre_monthly - $minus_pre_monthly;
    // Calculate the profit for the current month
    $monthlyProfit = ($plus_monthly - $minus_monthly);

    // Calculate the profit for the previous month
    $previousMonthlyProfit = ($plus_pre_monthly - $minus_pre_monthly);
    // Calculate the percentage change
    if ($previousMonthlyProfit != 0) {
        $percentChange = (($monthlyProfit - $previousMonthlyProfit) / abs($previousMonthlyProfit)) * 100;
    } else {
        // Handle the case where previousMonthlyProfit is 0
        if ($monthlyProfit > 0) {
            $percentChange = 100;
        } else {
            $percentChange = 0;
        }
    }

    // Create an array with the result
    $result = [
        'count' => ($monthlyProfit > $previousMonthlyProfit) ? 0 : 1,
        'percent' => $percentChange,
    ];

    return $result; // Return $result instead of $array
}

function getpartiename($id){
    $data = partie::where('partie_id',$id)->first();
    return $data->name;
}
function gettrans(){
    $data = cashier_payment::where('user_id', 'Expense')->latest()->take(5)->get();
    return $data;
}
function getInvoice(){
    $today = Carbon::today(); // Get the current date
    $data = invoice::whereDate('created_at', $today)->latest()->take(5)->get();
    return $data;
}
function getexpense(){
    $data = cashier_payment::where('user_id','Expense')->get()->sum('debit');
    return $data;
}
function getbackstich($id){
    $data = kadhilot::where('lot_id',$id)->first();
    if($data == ''){
        return '-------';
    }
    return $data->back_stich;
}
function getfrontstich($id){
    $data = kadhilot::where('lot_id',$id)->first();
    if($data == ''){
        return '-------';
    }
    return $data->front_stich;
}
function gettotalamountstich($id){
    $data = kadhilot::where('lot_id',$id)->first();
    if($data == ''){
        return '-------';
    }
    return $data->total_amount;
}
function createlotcard($request){
    $data = new lotcard;
        $id = IdGenerator::generate(['table' =>'lotcards','field'=>'card_id', 'length' => 10, 'prefix' =>'CARD-']);
            $data->card_id = $id;
            $data->user_id = session('user_id');
            $data->card_type = 'kadi';
            $data->fix_rate = ($request['back_amount'] / 1000) + ($request['front_amount'] / 1000);
            $data->working_area = 'kadi';
            $data->total_pcs = $request['back_stich'] + $request['front_stich'];
            $data->grand_total = $request['total_amount'];
            $data->verify_card = 0;
            $num = 2;
            if(isset($request['front_amount'])){
                $InData = new linklotcard;
                $InData->card_id = $id;
                $InData->user_id = session('user_id');
                $InData->lot_id = $request['lot_id'];
                $InData->description = 'front';
                $InData->quantity = $request['lot_quantity'];
                $InData->rate = $request['front_stich'] / 1000;
                $InData->role = session('role');
                $InData->total = $request['lot_quantity'] * $InData->rate;
                $InData->save();
            }
            if(isset($request['back_amount'])){
                $InData = new linklotcard;
                $InData->card_id = $id;
                $InData->user_id = session('user_id');
                $InData->lot_id = $request['lot_id'];
                $InData->description = 'front';
                $InData->quantity = $request['lot_quantity'];
                $InData->rate = $request['back_stich'] / 1000;
                $InData->role = 'kadi';
                $InData->total = $request['lot_quantity'] * $InData->rate;
                $InData->save();
            }
            if($data->save()){
                return true;
            }
            else{
                return false;
            }

}

function checklotcard($id){
    $checklot = linklotcard::where('lot_id',$id)->where('user_id',session('user_id'))->where('role','kadi')->first();
    if($checklot){
        return false;
    }
    else{
        return true;
    }
}
function getname($id){
    $user = register::where('user_id',$id)->first();
    if($user != ''){
        return $user->name;
    }
    else {
        return $id;
    }
}
function getpartiestatus($id){
    $data = partie::where('partie_id',$id)->first();
    return $data->status;
}

function getpartieaddress($id){
    $data = partie::where('partie_id', $id)->first();
    return $data;
}

function getInvoiceRecord($id) {
    $data = invoice::where('invoice_id', $id)->first();
    if($data){
        $html = 'Total Pcs-Meter: ' . $data->total_pcs . '<br /> Avg Rate: ' . number_format($data->grand_total / $data->total_pcs, 2);
        return $html;
    }
    else{
        return '';
    }
    
}

function getSalary($id){
    $user = register::where('user_id',$id)->first();
    if($user != ''){
        return $user->salary;
    }
    else {
        return 0;
    }
}

function getRemainingRoll($id){
    $data = linkRoll::where('rollId',$id)->where('rollUseStatus',0)->get()->sum('rollQuantity');
    return $data;
}
function getSubRollQuantity($id){
    $data = linkRoll::where('rollSubId',$id)->first();
    $data->rollUseStatus = 1;
    $data->save();
    return $data->rollQuantity;
}




?>
