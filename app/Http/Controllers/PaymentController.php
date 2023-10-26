<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\partie;
use App\Models\cashier_payment;
use App\Models\parties_ledger;
use App\Models\register;
use App\Models\weeklypayment;
use App\Models\link_weekly_payments;
use App\Models\employee_ledger;
use Illuminate\Support\Facades\DB;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;

class PaymentController extends Controller
{
    public function PartiesPayments(){
        $data = partie::where('status','active')->get();
        return view('payments/parties_payments',['data'=>$data]);
    }

    // public function PartiesLedger($id){
    //     dd($id);

    // }
    public function CashierLedger(){
        $config = ['table'=>'cashier_payments','field'=>'pay_id','length'=>10,'prefix'=>'PAY-'];
        $id = IdGenerator::generate($config);
        if(session('role') == 'admin'){
            $CashEntry = cashier_payment::all();
        }
        else{
            $CashEntry = cashier_payment::where('given_by', session('user_id'))->get();
        }
        $EmpData = register::all();
        $ParData = partie::all();
        $CashierData = register::where('role','cashier')->orwhere('role','manager')->get();
        return view('payments.cashier_payments',['debit_id'=>$id])->with('Empdata',$EmpData)->with('CashData',$CashierData)
        ->with('CashEntry',$CashEntry)
        ->with('ParData',$ParData);
    }
    public function PayDebit(Request $req){
        $data = new cashier_payment;
        $data->pay_id = $req->inputDebitID;
        // dd($req->user_id);
        if($req->user_id != 'Expense' && $req->debit != ''){
            $config = ['table'=>'employee_ledgers','field'=>'payment_id','length'=>12,'prefix'=>'EMPPAY-'];
            $Pid = IdGenerator::generate($config);
            $EmpData = new employee_ledger;
            $EmpData->payment_id = $Pid;
            $EmpData->employee_id = $req->user_id;
            $EmpData->description = $req->description;
            $EmpData->debit = $req->debit;
            $EmpData->credit = $req->credit;
            $EmpData->given_by = $req->given_by;
            $EmpData->save();
        }
        if($req->user_id != 'Company' && $req->credit != ''){
            $config = ['table'=>'parties_ledgers','field'=>'payment_id','length'=>12,'prefix'=>'PRTYPAY-'];
            $Pid = IdGenerator::generate($config);
            $EmpData = new parties_ledger;
            $EmpData->payment_id = $Pid;
            $EmpData->parties_id = $req->user_id;
            $EmpData->description = 'Debit By Cashier';
            $EmpData->debit = $req->credit;
            // $EmpData->credit = $req->credit;
            $EmpData->given_by = $req->given_by;
            $EmpData->save();
        }
        $data->user_id = $req->user_id;
        $data->description = $req->description;
        $data ->verify = 0;
        $data->debit = $req->debit;
        $data->credit = $req->credit;
        $data->given_by = $req->given_by;
        $data->save();
        return redirect()->back();
    }
    public function PartiesLedger($id){
            $config = ['table'=>'parties_ledgers','field'=>'payment_id','length'=>12,'prefix'=>'PRTYPAY-'];
            $Pid = IdGenerator::generate($config);
            $PRTYID = partie::where('partie_id',$id)->first();
            $PartiesLedger = parties_ledger::where('parties_id', $id)->orderBy('created_at', 'asc')->get();
            return view('payments.ledger')->with('ledger',$PartiesLedger)->with('PAYID',$Pid)
            ->with('PRTYID',$PRTYID);
    }
    public function Partie_Credit(Request $req){
        try {
            if($req->trans_id != ''){
                $check = parties_ledger::where('trans_id', $req->trans_id)->first();
            
                if ($check) {
                    $dateString = $check->created_at;
                    $dateTime =  Carbon::parse($dateString);
                    $formattedDate  = $dateTime->format('j F y , H:i');
                    return redirect()->back()->with('error', 'Trans ID Exist ' . $check->trans_id . ' Date: ' . $formattedDate);
                } else {
                    $data = new parties_ledger;
                    $data->payment_id = $req->inputDebitID;
                    $data->trans_id = $req->trans_id;
                    $data->parties_id = $req->parties_id;
                    $data->description = $req->description;
                    $data->debit = $req->debit;
                    $data->credit = $req->credit;
                    $data->given_by = $req->given_by;
                    $data->created_at = Carbon::parse($req->date);
                    $data->save();
                    return redirect()->back();
                }
            }
            else{
                $data = new parties_ledger;
                $data->payment_id = $req->inputDebitID;
                $data->trans_id = $req->trans_id;
                $data->parties_id = $req->parties_id;
                $data->description = $req->description;
                $data->debit = $req->debit;
                $data->credit = $req->credit;
                $data->given_by = $req->given_by;
                $data->created_at = Carbon::parse($req->date);
                $data->save();
                return redirect()->back();
            }
        } catch (\Exception $e) {
            // Handle exceptions here
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }        
    }
    public function Employee_Payments(){
        if(session('role') == 'admin'){
            $data = register::all();
        }
        else{
            $data = register::where('user_id',session('user_id'))->get();
        }
        return view('payments.employee_payments',['data'=>$data]);
    }
    public function Employee_Ledger($id){
        $config = ['table'=>'employee_ledgers','field'=>'payment_id','length'=>12,'prefix'=>'EMPPAY-'];
            $Pid = IdGenerator::generate($config);
            $EMPID = $id;
            $PartiesLedger = employee_ledger::where('employee_id',$id)->get();
            return view('payments.employee_ledger')->with('ledger',$PartiesLedger)->with('PAYID',$Pid)
            ->with('EMPID',$EMPID);
    }
    public function Employee_Credit(Request $req){
        $data = new employee_ledger;
        $data->payment_id = $req->inputDebitID;
        $data->employee_id = $req->user_id;
        $data->description = $req->description;
        $data->debit = $req->debit;
        $data->credit = $req->credit;
        $data->given_by = $req->given_by;
        $data->save();
        return redirect()->back();
    }

    public function DeletePartiePayid($id){
        $data = parties_ledger::where('payment_id',$id)->first();
        $data->delete();
        Alert::success('Payment Deleted',' Transcation Deleted Successfully');
        return response()->json();
    }
    public function weekly_payments(){
        $config = ['table'=>'weeklypayments','field'=>'week_id','length'=>10,'prefix'=>'WPAY-'];
        $Pid = IdGenerator::generate($config);
        $employees = register::where('status','active')->get();
        return view('payments.Week_Payments.add_weekly_payments',compact('Pid','employees'));
    }
    public function add_weekly_payments(Request $request){
        $week_pay = new weeklypayment;
        $week_pay->week_id = $request->week_id;
        $week_pay->created_by = session('user_id');
        $week_pay->total_amount = $request->total_amount;
        $week_pay->recieved_amount = $request->recieved_amount;
        $week_pay->remaining_amount = $request->remaining_amount;

        $employeeCount = count($request->employee_id);
            for ($i = 0; $i < $employeeCount; $i++) {
                $weekpay = new link_weekly_payments;
                $weekpay->week_id = $request->week_id;
                $weekpay->emp_id = $request->employee_id[$i]; // Use the current employee_id from the array
                $weekpay->name = $request->name[$i]; // Use the corresponding name from the array
                $weekpay->amount = $request->debit[$i]; // Use the corresponding debit from the array
                $weekpay->signature = $request->signature[$i]; // Use the corresponding signature from the array
                $weekpay->save();
            }

        for( $index = 0; $index < count($request->employee_id); $index++) {
            if($request->debit[$index] > 0){
                $config = ['table'=>'employee_ledgers','field'=>'payment_id','length'=>12,'prefix'=>'EMPPAY-'];
                $Pid = IdGenerator::generate($config);
                $EMPID = $Pid;
                $data = new employee_ledger;
                $data->payment_id = $EMPID;
                $data->employee_id = $request->employee_id[$index];
                $data->description = 'Weekly Payment';
                $data->debit = $request->debit[$index];
                $data->weekly_pay_id =  $request->week_id;
                $data->save();
            }
        }
        $week_pay->save();
        return redirect()->back()->with('success', 'Weekly Payments stored successfully.');
    }
    public function delete_employee_payment($id){
        $data = employee_ledger::where('payment_id',$id)->first();
        $data->delete();
        return redirect()->back()->with('success', 'Payment Delete stored successfully.');
    }
    public function print_weekly_payemnts(){
        $config = ['table'=>'weeklypayments','field'=>'week_id','length'=>10,'prefix'=>'WPAY-'];
        $Pid = IdGenerator::generate($config);
        $employees = register::where('status','active')->get();
        return view('payments.print_weekly_payments',compact('Pid','employees'));
    }
    public function update_cash($id){
        $data = cashier_payment::where('pay_id',$id)->first();
        return view('payments.update_cashier_payments',compact('data'));
    }
    public function update_cash_data(Request $request){
        $data = cashier_payment::where('pay_id',$request->pay_id)->first();
        $data->description = $request->description;
        if ($request->debit) {
            $data->debit = $request->debit;
        } else {
            $data->credit = $request->credit;
        }
        if($request->has('verify')){
            $data->verify = 1;
        }
        $data->save();

        return redirect('cashier_payments')->with('success', 'Payment Edit Successfully');
    }
    public function update_parties_cash($id){
        $data = parties_ledger::where('payment_id',$id)->first();
        return view('payments.update_parties_payments',compact('data'));
    }
    public function update_partie_cash_data(Request $request){
        try {
            $data = parties_ledger::where('payment_id', $request->payment_id)->first();
        
            if ($request->description !== '') {
                $data->description = $request->description;
            }
        
            $data->trans_id = $request->trans_id;
        
            if ($request->debit) {
                $data->debit = $request->debit;
            } else {
                $data->credit = $request->credit;
            }
        
            $data->created_at = Carbon::parse($request->date);
            $data->save();
        
            return redirect('parties_ledger/'.$data->parties_id)->with('success', 'Payment '.$request->payment_id.' Edit Successfully');
        } catch (\Exception $e) {
            // Handle exceptions here
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }    
    }
    public function week_payments(){
        $data = weeklypayment::all();
        return view('payments.Week_Payments.weekly_payments',compact('data'));
    }
    public function week_payments_id($id){
        $data = weeklypayment::where('week_id',$id)->first();
        $weekpay = link_weekly_payments::where('week_id',$data->week_id)->get();

        return view('payments.Week_Payments.view_weekly_payment_id',compact('data','weekpay'));
    }
}
