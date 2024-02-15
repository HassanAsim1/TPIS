<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LotController;
use App\Http\Controllers\PartiesController;
use App\Http\Controllers\fabricController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\InvoiceController;
use Illuminate\Http\Request;
use App\Models\fabric;
use App\Models\lot;
use App\Models\workingArea;
use App\Models\register;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('login');
});
Route::get('login', function () {
    return view('login');
});
Route::post("login",[UserController::class,'login']);

Route::get('register', function () {
    $data = workingArea::all();
    return view('register',compact('data'));
});
Route::post("register",[UserController::class,'addData']);

Route::get('logout', function (Request $req)
 {
    if(session()->has('email') || session()->has('name') || session()->has('role') || session()->has('id')){
        session()->pull('email');
        session()->pull('name');
        session()->pull('role');
        session()->pull('id');
    }
    return redirect('login');

});


Route::group(['middleware'=>['ProtectedPage']],function(){
    Route::get('dashboard', function () {
        return view('dashboard.dashboard');
    });
    //   ---------------------  Hamza Routes -----------------
    Route::get('emptable',[UserController::class,'EmpTable'])->name('Emptable');
    Route::get('viewemp/{id}',[UserController::class,'ViewEmp']);
    Route::get('editemp/{id}',[UserController::class,'EditEmp']);
    Route::post('editemp',[UserController::class, 'update']);
    Route::post('add_partie',[PartiesController::class, 'add_parties']);
    Route::get('editparty/{id}',[PartiesController::class,'EditParties']);
    Route::post('editparty',[PartiesController::class, 'Update']);
    Route::get('addshirt',[LotController::class,'addshirt']);
    // Route::view('lotcard','employeesection.lotcard');
    Route::view('fabrics','dashboard.fabrics');
    Route::post('add_fabric',[fabricController::class,'add_fabric']);
    Route::get('fabrics',[fabricController::class, 'fabrics']);
    Route::get('view_invoice',[LotController::class,'ViewInvoice'])->name('view_invoice');
    Route::get('view_detail_invoice/{id}',[LotController::class,'ViewInvDetail']);
    Route::get('/get-fix-rate/{id}', [UserController::class,'getFixRate'])->name('get-fix-rate');
    Route::get('/invoiceEdit/{id}', [LotController::class,'invoiceEdit'])->name('invoiceEdit');

    //---------------------- Hassan Route --------------------

    Route::get('parties',[PartiesController::class, 'parties'])->name('partie');
    Route::get('pantlot',[LotController::class, 'PantLot'])->name('pant_lot');
    Route::post('add_pant_lot',[LotController::class, 'Add_Pant_Lot']);
    Route::get('editpantlot/{id}',[LotController::class,'EditPantLot']);
    Route::get('TrackPant',[LotController::class,'TrackPantLot']);
    Route::get('lotcard',[LotController::class,'LotCard'])->name('lotcard');
    Route::get('shirtlot',[LotController::class,'ShirtLot'])->name('shirtlot');
    Route::get('editshirtlot/{id}',[LotController::class,'editshirtlot'])->name('editshirtlot');
    Route::post('editShirtLotData',[LotController::class,'editShirtLotData'])->name('editShirtLotData');
    Route::post('addshirtlot',[LotController::class,'InsertShirtLot'])->name('InsertShirtlot');
    Route::get('bill_invoice',[LotController::class,'bill_inv'])->name('b_inv');
    Route::post('bill_inv',[LotController::class,'InsertInvoice'])->name('insert_bill_inv');
    Route::post('updateInvoice',[LotController::class,'updateInvoice'])->name('updateInvoice');
    Route::post('addpantlot',[LotController::class,'InsertPantLot'])->name('InsertPantlot');
    Route::get('verify_card',[LotController::class,'CardVerify'])->name('CardVerify');
    Route::get('verify_card/{id}',[LotController::class,'CardVerifyID'])->name('CardVerifyID');
    Route::get('parties_ledger/delete/{id}',[LotController::class,'DeletePartiePayid']);
    Route::get('viewlot/{id}',[LotController::class,'ViewLotDetail']);
    Route::post('adminverify',[LotController::class,'VerifyCardAdmin'])->name('AdminVerify');
    Route::get('addpant',function(){
        $data = lot::orderBy('lot_id','DESC')->get();
        $master = register::where('role','master')->get();
        $mstatus = register::where('email',session('email'))->first();
        $FabData = fabric::where('remainingMeter','>',0)->get();
        // dd($FabData);
        return view('lot.addpantlot',compact('data','master','mstatus','FabData'));
    });
    Route::get('kadhilot',[LotController::class,'KadhiLot'])->name('kadhilot');

    Route::get('parties_payments',[PaymentController::class,'PartiesPayments'])->name('parties_payments');
    Route::get('parties_ledger/{id}',[PaymentController::class,'PartiesLedger']);
    Route::get('cashier_payments',[PaymentController::class,'CashierLedger']);
    Route::post('adddebitemp',[PaymentController::class,'PayDebit']);
    Route::post('partie_credit',[PaymentController::class,'Partie_Credit']);
    Route::get('employee_payments',[PaymentController::class,'Employee_Payments']);
    Route::get('employees_ledger/{id}',[PaymentController::class,'Employee_Ledger']);
    Route::post('employee_credit',[PaymentController::class,'Employee_Credit']);
    Route::get('parties_ledger/delete/{id}',[PaymentController::class,'DeletePartiePayid']);
    Route::get('cashier_payments/{id}',[PaymentController::class,'update_cash']);
    Route::post('edit_cash_payment', [PaymentController::class,'update_cash_data']);
    Route::get('parties_payment/{id}',[PaymentController::class,'update_parties_cash']);
    Route::post('edit_partie_cash_payment', [PaymentController::class,'update_partie_cash_data']);


    // --------------------- Saad Routes ------------------------

    Route::post('deleteemp',[UserController::class,'deleteemp']);
    Route::get('getpartiesdetails/{id}',[PartiesController::class, 'partie_detail']);
    Route::get('addkadhilot/{id}',[LotController::class, 'addkadhilot'])->name('addkadhilot');
    Route::post('addkadhilotdetails',[LotController::class, 'addkadhilotdetails']);
    Route::get('next/{id}',[LotController::class,'Next']);
    Route::get('back/{id}',[LotController::class,'Back']);
    Route::get('shirtnext/{id}',[LotController::class,'shirtNext']);
    Route::get('shirtback/{id}',[LotController::class,'shirtBack']);

    Route::get('weekly_payments',[PaymentController::class,'weekly_payments']);
    Route::post('weekly_payments',[PaymentController::class,'add_weekly_payments']);
    Route::get('delete_employee_payment/{id}',[PaymentController::class, 'delete_employee_payment']);
    Route::get('print_weekly_payments',[PaymentController::class, 'print_weekly_payemnts']);
    Route::get('show-weekly-payments',[PaymentController::class, 'week_payments']);
    Route::get('weekly_payments/{id}',[PaymentController::class, 'week_payments_id']);


    Route::get('show-verify-card',[LotController::class, 'show_verify_card']);
    Route::get('show-verify-card-by-id/{id}',[LotController::class, 'show_verify_card_by_id']);
    Route::get('delete-verify-card/{id}',[LotController::class, 'delete_verify_card']);
    Route::get('delete-verify-card/{id}',[LotController::class, 'delete_verify_card']);
    Route::get('/generate-invoice', [InvoiceController::class,'generateInvoice'])->name('generate-invoice');
    Route::get('/printPartieInvoice/{partie_id}', [InvoiceController::class,'printPartieInvoice'])->name('printPartieInvoice');
    Route::get('/printBillInvoice/{invoice_id}', [InvoiceController::class,'printBillInvoice'])->name('printBillInvoice');
    Route::get('/checkLot', [LotController::class,'checkLot'])->name('checkLot');
    Route::get('/printEmployeeInvoice/{employeeId}', [InvoiceController::class,'printEmployeeInvoice'])->name('printEmployeeInvoice');
    Route::get('/removeLot', [LotController::class,'removeLot'])->name('removeLot');
    Route::get('/disableEmployees', [LotController::class,'disableEmployees'])->name('disableEmployees');
    Route::get('/activeEmployees', [LotController::class,'activeEmployees'])->name('activeEmployees');
    Route::get('/fabricDetail/{id}', [fabricController::class,'fabricDetail'])->name('fabricDetail');

    // Roll Details
    Route::get('/addRoll', [fabricController::class,'addRoll'])->name('addRoll');
    Route::post('addRollData', [fabricController::class,'addRollData'])->name('addRollData');
    Route::get('viewRoll', [fabricController::class,'viewRoll'])->name('viewRoll');
    Route::get('editRoll/{id}', [fabricController::class,'editRoll'])->name('editRoll');
    Route::post('updateRollData', [fabricController::class,'updateRollData'])->name('updateRollData');

    // Fabric Section

    Route::get('/addFabricLot', [fabricController::class,'addFabricLot'])->name('addFabricLot');
    Route::get('/getRollIdData/{id}', [fabricController::class,'getRollIdData'])->name('getRollIdData');
    Route::get('/getFabricLotQuantity/{id}', [fabricController::class,'getFabricLotQuantity'])->name('getFabricLotQuantity');
    Route::get('/rollInvoice/{id}', [InvoiceController::class,'rollInvoice'])->name('rollInvoice');
    // Route::get('/fabricDetailId/{id}', [fabricController::class,'fabricDetailId'])->name('fabricDetailId');

    //Working Area

    Route::get('/workingArea', [LotController::class,'workingArea'])->name('workingArea');
    Route::post('/addWorkingArea', [LotController::class,'addWorkingArea'])->name('addWorkingArea');
    Route::get('/deleteWorkingArea/{id}', [LotController::class,'deleteWorkingArea'])->name('deleteWorkingArea');
    Route::get('/changeWorkingArea', [LotController::class,'changeWorkingArea'])->name('changeWorkingArea');
    Route::post('/addChangeWorkingArea', [LotController::class,'addChangeWorkingArea'])->name('addChangeWorkingArea');

    // Add Lot By Admin
    Route::post('addLotData',[LotController::class,'addLotData'])->name('addLotData');
    Route::get('addLot',[LotController::class,'addLot'])->name('addLot');
    Route::get('cashierInvoice',[InvoiceController::class,'cashierInvoice'])->name('cashierInvoice');
    Route::get('timeline',[LotController::class,'timeline'])->name('timeline');

});


