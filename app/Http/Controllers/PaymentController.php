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
use App\Models\invoice;
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
    public function CashierLedger(Request $request){
        $config = ['table' => 'cashier_payments', 'field' => 'pay_id', 'length' => 10, 'prefix' => 'PAY-'];
        $id = IdGenerator::generate($config);
        if($request->has('user_id')){
            $CashEntry = cashier_payment::where('given_by', $request->user_id)->get();
        }
        else{
            if (session('role') == 'admin') {
                $CashEntry = cashier_payment::latest()->take(20)->get();
                $creditSum = cashier_payment::sum('credit');
                $debitSum = cashier_payment::sum('debit');
                $balance = $creditSum - $debitSum;
            } else {
                $creditData = cashier_payment::where('given_by', session('user_id'))->sum('credit');
                $debitData = cashier_payment::where('given_by', session('user_id'))->sum('debit');
                $balance = $creditData - $debitData;
                $CashEntry = cashier_payment::where('given_by', session('user_id'))->latest()->take(30)->get();
            }
        }
        
        $EmpData = register::all();
        $cashiers = register::where('role','cashier')->orWhere('role','admin')->get();
        $ParData = partie::all();
        $CashierData = register::where('role', 'cashier')->orWhere('role', 'manager')->get();

        return view('payments.cashier_payments', ['debit_id' => $id])
            ->with('Empdata', $EmpData)
            ->with('CashData', $CashierData)
            ->with('CashEntry', $CashEntry)
            ->with('ParData', $ParData)
            ->with('cashiers',$cashiers)
            ->with('balance', $balance);
    }
    public function getAllCashierPayments(Request $request){
        $config = ['table' => 'cashier_payments', 'field' => 'pay_id', 'length' => 10, 'prefix' => 'PAY-'];
        $id = IdGenerator::generate($config);
        if($request->has('user_id')){
            $CashEntry = cashier_payment::where('given_by', $request->user_id)->get();
        }
        else{
            if (session('role') == 'admin') {
                $CashEntry = cashier_payment::all();
                $creditSum = cashier_payment::sum('credit');
                $debitSum = cashier_payment::sum('debit');
                $balance = $creditSum - $debitSum;
            } else {
                $creditData = cashier_payment::where('given_by', session('user_id'))->get('credit');
                $debitData = cashier_payment::where('given_by', session('user_id'))->get('debit');
                $balance = $creditData - $debitData;
                $CashEntry = cashier_payment::where('given_by', session('user_id'))->get();
            }
        }
        
        $EmpData = register::all();
        $cashiers = register::where('role','cashier')->orWhere('role','admin')->get();
        $ParData = partie::all();
        $CashierData = register::where('role', 'cashier')->orWhere('role', 'manager')->get();

        return view('payments.getAllCashierRecord' , ['debit_id' => $id])
            ->with('Empdata', $EmpData)
            ->with('CashData', $CashierData)
            ->with('CashEntry', $CashEntry)
            ->with('ParData', $ParData)
            ->with('cashiers',$cashiers)
            ->with('balance', $balance);
    }
    public function PayDebit(Request $req){
        try {
            DB::beginTransaction();
        
            $data = new cashier_payment;
            $config = ['table' => 'cashier_payments', 'field' => 'pay_id', 'length' => 10, 'prefix' => 'PAY-'];
            $id = IdGenerator::generate($config);
            $data->pay_id = $id;
        
            if ($req->user_id != 'Expense' && $req->debit != '') {
                $config = ['table' => 'employee_ledgers', 'field' => 'payment_id', 'length' => 12, 'prefix' => 'EMPPAY-'];
                $Pid = IdGenerator::generate($config);
                $EmpData = new employee_ledger;
                $EmpData->payment_id = $Pid;
                $EmpData->cashierPayId = $req->inputDebitID;
                $EmpData->employee_id = $req->user_id;
                $EmpData->description = $req->description;
                $EmpData->debit = $req->debit;
                $EmpData->credit = $req->credit;
                $EmpData->given_by = $req->given_by;
                $EmpData->save();
            }
        
            if ($req->user_id != 'Company' && $req->credit != '') {
                $config = ['table' => 'parties_ledgers', 'field' => 'payment_id', 'length' => 12, 'prefix' => 'PRTYPAY-'];
                $Pid = IdGenerator::generate($config);
                $EmpData = new parties_ledger;
                $EmpData->payment_id = $Pid;
                $EmpData->cashierPayId = $req->inputDebitID;
                $EmpData->parties_id = $req->user_id;
                $EmpData->description = 'Debit By Cashier';
                $EmpData->debit = $req->credit;
                $EmpData->given_by = $req->given_by;
                $EmpData->save();
            }
        
            $data->user_id = $req->user_id;
            $data->description = $req->description;
            $data->verify = 0;
            $data->debit = $req->debit;
            $data->credit = $req->credit;
            $data->given_by = $req->given_by;
            $data->save();
        
            DB::commit();
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            // Handle the exception (e.g., log it, show an error message)
            return redirect()->back()->with('error', 'Transaction failed: ' . $e->getMessage());
        }
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
        $employees = register::where('status','active')->get();
        return view('payments.update_cashier_payments',compact('data','employees'));
    }
    public function update_cash_data(Request $request){
        // dd($request->user_id);
        $data = cashier_payment::where('pay_id',$request->pay_id)->first();
        $data->description = $request->description;
        $data->user_id = $request->user_id;
        if($request->user_id != 'Expense' && $request->user_id != 'Company' && $data->credit == ''){
            $empData = employee_ledger::where('cashierPayId',$request->pay_id)->first();
            // dd($empData);
            $empData->employee_id = $request->user_id;
            $empData->debit = $request->debit;
            $empData->save();
        }
        if($request->user_id != 'Expense' && $request->user_id != 'Company' && $data->debit == ''){
            $empData = employee_ledger::where('cashierPayId',$request->pay_id)->first();
            if($empData){
                $empData->employee_id = $request->user_id;
                $empData->credit = $request->credit;
                $empData->save();
            }
        }
        if ($request->debit) {
            $data->debit = $request->debit;
        } else {
            $data->credit = $request->credit;
        }
        if($request->has('verify')){
            $data->verify = 1;
        }
        else{
            $data->verify = 0;
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
    public function report(Request $request){
        $parties = partie::where('partie_id',$request->partieId)->first();
        $pants = invoice::where('partie_id',$request->partieId)->where('bill_type','pant_bill')->sum('total_pcs');
        $shirts = invoice::where('partie_id',$request->partieId)->where('bill_type','shirt_bill')->sum('total_pcs');
        $pantShirts = invoice::where('partie_id',$request->partieId)->where('bill_type','Pant & Shirt Bill')->sum('total_pcs');
        $fabrics = invoice::where('partie_id',$request->partieId)->where('bill_type','Fabric Bill')->sum('total_pcs');

        $currentDate = Carbon::now();

        // Yearly data
        $yearlyData = invoice::where('partie_id', $request->partieId)
            ->whereYear('created_at', $currentDate->year)
            ->sum('total_pcs');

        // Quarterly data
        $quarterlyData = invoice::where('partie_id', $request->partieId)
            ->whereBetween('created_at', [$currentDate->startOfQuarter(), $currentDate->endOfQuarter()])
            ->sum('total_pcs');

        // Monthly data
        $monthlyData = invoice::where('partie_id', $request->partieId)
            ->whereMonth('created_at', $currentDate->month)
            ->sum('total_pcs');

        // Total pcs
        $totalPcs = $yearlyData + $quarterlyData + $monthlyData;

        return view('payments.report',compact('pants','shirts','pantShirts','fabrics','parties', 'yearlyData', 'quarterlyData', 'monthlyData', 'totalPcs'));
    }
    public function customReport(Request $request){
        if($request->has('partieId')){
            // Parse the request dates
            $formDate = Carbon::parse($request->input('formDate'));
            $toDate = Carbon::parse($request->input('toDate'));

            $parties = partie::where('partie_id', $request->partieId)->first();

            $pants = invoice::where('partie_id', $request->partieId)
                ->where('bill_type', 'pant_bill')
                ->whereBetween('created_at', [$formDate, $toDate])
                ->sum('total_pcs');

            $shirts = invoice::where('partie_id', $request->partieId)
                ->where('bill_type', 'shirt_bill')
                ->whereBetween('created_at', [$formDate, $toDate])
                ->sum('total_pcs');

            $pantShirts = invoice::where('partie_id', $request->partieId)
                ->where('bill_type', 'Pant & Shirt Bill')
                ->whereBetween('created_at', [$formDate, $toDate])
                ->sum('total_pcs');

            $fabrics = invoice::where('partie_id', $request->partieId)
                ->where('bill_type', 'Fabric Bill')
                ->whereBetween('created_at', [$formDate, $toDate])
                ->sum('total_pcs');

            // Total pcs for the specified date range
            $totalPcsDateRange = $pants + $shirts + $pantShirts + $fabrics;

            // Assuming you still want the total pcs for the entire year, quarter, and month
            $currentDate = Carbon::now();

            // Yearly data
            $yearlyData = invoice::where('partie_id', $request->partieId)
                ->whereYear('created_at', $currentDate->year)
                ->sum('total_pcs');

            // Quarterly data
            $quarterlyData = invoice::where('partie_id', $request->partieId)
                ->whereBetween('created_at', [$currentDate->startOfQuarter(), $currentDate->endOfQuarter()])
                ->sum('total_pcs');

            // Monthly data
            $monthlyData = invoice::where('partie_id', $request->partieId)
                ->whereMonth('created_at', $currentDate->month)
                ->sum('total_pcs');

            // Total pcs for the entire year, quarter, and month
            $totalPcs = $yearlyData + $quarterlyData + $monthlyData;

            return view('payments.report', compact('pants', 'shirts', 'pantShirts', 'fabrics', 'parties', 'yearlyData', 'quarterlyData', 'monthlyData', 'totalPcs', 'totalPcsDateRange'));
        }
        else{
            $parties = partie::all();
            return view('payments.customReport',compact('parties'));
        }
    }
    public function getStatusData()
    {
        $statusData = $this->getStatusDataFromHelper();
        return response()->json($statusData);
    }
    private function getStatusDataFromHelper()
    {
        $currentYear = Carbon::now()->year;

        // Get the parties with a total_pcs greater than 2000
        $selectedParties = DB::table('invoices')
            ->select('partie_id', DB::raw('SUM(total_pcs) as total_pcs'))
            ->whereYear('created_at', $currentYear)
            ->groupBy('partie_id')
            ->havingRaw('SUM(total_pcs) > 2000')
            ->get();

        // Get the parties with a total_pcs less than or equal to 2000
        $otherParties = DB::table('invoices')
            ->select('partie_id', DB::raw('SUM(total_pcs) as total_pcs'))
            ->whereYear('created_at', $currentYear)
            ->groupBy('partie_id')
            ->havingRaw('SUM(total_pcs) <= 2000')
            ->get();

        // Extract labels, series, and calculate the total_pcs for "Others"
        $labels = $selectedParties->pluck('partie_id')->toArray();
        $series = $selectedParties->pluck('total_pcs')->toArray();
        $colors = ['#6697EE', '#EEAA66', '#48C9B0', '#7D3C98', '#F4D03F', '#EC7063', '#2E4053', '#229954', '#909497', '#AED6F1', '#7B241C', '#CA6F1E', '#512E5F', '#7B7D7D'];

        // Calculate the total_pcs for "Others"
        $otherTotalPcs = $otherParties->sum('total_pcs');

        // Add "Others" section if there are parties with total_pcs less than or equal to 2000
        if ($otherTotalPcs > 0) {
            $labels[] = 'Others';
            $series[] = $otherTotalPcs;
            $colors[] = '#CCCCCC'; // You can set a specific color for "Others"
        }

        // Get party names for each party ID
        $partyNames = [];
        foreach ($labels as $partyId) {
            $partyNames[] = ($partyId !== 'Others') ? getpartiename($partyId) : 'Others';
        }

        return [
            'labels' => $partyNames,
            'series' => $series,
            'colors' => $colors,
        ];

    }
}
