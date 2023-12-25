<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use App\Models\parties_ledger;
use App\Models\partie;
use App\Models\register;
use App\Models\employee_ledger;
use App\Models\cashier_payment;
use App\Models\invoice;
use App\Models\linkinvoice;

class InvoiceController extends Controller
{
    public function generateInvoice()
    {
        if(session('role') == 'admin'){
            $CashEntry = cashier_payment::all();
        }
        else{
            $CashEntry = cashier_payment::where('given_by', session('user_id'))->get();
        }
        $pdf = new Dompdf();
        $html = view('invoice.cashier_invoice')->with('CashEntry',$CashEntry)->render();

        $pdf->loadHtml($html);
        $pdf->setPaper('A4', 'portrait');
        $pdf->render();
        $filename = getname(session('user_id')) . '.pdf';
        return $pdf->stream($filename);
    }
    public function printPartieInvoice($partie_id){
        $PRTYID = partie::where('partie_id', $partie_id)->first();
        $PartiesLedger = parties_ledger::where('parties_id', $partie_id)->orderBy('created_at', 'asc')->get();
        return view('invoice.printparties_invoice')->with('ledger', $PartiesLedger)->with('PRTYID', $PRTYID);
    }
    public function printBillInvoice($invoiceId){
        $Invdata = invoice::where('invoice_id',$invoiceId)->first();
        $data = linkinvoice::where('invoice_id',$invoiceId)->get();
        // dd($data);
        return view('invoice.invoice',compact('data','Invdata'));
    }
    public function printEmployeeInvoice($employeeId){
        $employee = register::where('user_id', $employeeId)->first();
        $employeeData = employee_ledger::where('employee_id', $employeeId)->orderBy('created_at', 'asc')->get();
        return view('invoice.employee.employeInvoice')->with('employee', $employee)->with('employeeData', $employeeData);
    }
    public function rollInvoice($id){
        $roll = Roll::where('rollId',$id)->first();
    }
    public function cashierInvoice(){
        $data = cashier_payment::where('given_by',session('user_id'))->get();
        // dd($data);
        if($data){
            return view('invoice.cashierInvoice',compact('data'));
        }
        else{
            return redirect()->back()->with('error','User Not Exist');
        }
    }
}
