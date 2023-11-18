<?php

namespace App\Http\Controllers;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use App\Models\register;
use App\Models\lot;
use App\Models\linklotcard;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    //
    function addData(Request $req)
    {
        try {
            $data = new register;
            $checkdata = register::where('email', $req->email)->first();
            if ($checkdata) {
                session()->put('error', $req->email . ' is already registered.');
                return redirect()->back();
            }
        
            $data->address = $req->address;
            $data->name = $req->name;
            $data->email = $req->email;
            $data->password = Hash::make($req->password);
            $data->working_area = $req->WorkingArea;
            $data->bankAccountNumber = $req->bankAccountNumber;
            $data->bankAccountName = $req->bankAccountName;
            $data->bankName = $req->bankName;
            
            if ($req->salaryno == "") {
                $data->salary = "";
            } else {
                $data->salary = $req->salaryno;
            }
            
            if ($req->fix_rate == "") {
                $data->fix_rate = "";
            } else {
                $data->fix_rate = $req->fix_rate;
            }
        
            $data->method_salary = $req->MethodofSalary;
            $data->role = $req->role;
        
            $id = [
                'table' => 'registers',
                'field' => 'user_id',
                'length' => 7,
                'prefix' => 'EMP-',
                'reset_on_prefix_change' => true
            ];
            $data->user_id = IdGenerator::generate($id);
        
            $data->cnic = $req->cnic;
            $data->phone_no = $req->phonenumber;
            $data->status = $req->status;
        
            if ($data->save()) {
                Alert::success('success', $data->name . ' Register Successful');
                if (session()->has('role') == 'admin') {
                    return redirect('emptable');
                } else {
                    return view('login');
                }
            } else {
                return redirect()->back();
            }
        } catch (\Exception $e) {
            session()->put('error', 'An error occurred: ' . $e->getMessage());
            return redirect()->back();
        }
        
    }


    function login(Request $req)
    {
        $data = register::where('email',$req->email)->first();
        $loginStatus = register::where('loginStatus',0)->first();
    //    dd($data);
    // dd($data);
       if($data->loginStatus == 1 && $data->status == 'active'){
            if($data != '' && password_verify($req->password,$data->password))
            {
                    $ses_email = $req->email;
                    $ses_role = $data->role;
                    $ses_name = $data->name;
                    $ses_id = $data->user_id;
                    $fixrate = $data->fix_rate;
                    $ses_area = $data->working_area;
                    $status = $data->status;
                    $req->session()->put('email',$ses_email);
                    $req->session()->put('role',$ses_role);
                    $req->session()->put('name',$ses_name);
                    $req->session()->put('user_id',$ses_id);
                    $req->session()->put('working_area',$ses_area);
                    $req->session()->put('fix_rate',$fixrate);
                    if($loginStatus != ''){
                        $req->session()->put('loginStatus','Disable');
                    }
                    else{
                        $req->session()->put('loginStatus','Active');
                    }
                    // $req->session()->put('user_status',$status);
                    if($ses_role == 'master' || $ses_role == 'admin'){
                        $master_id = $data->user_id;
                        $req->session()->put('master_id',$master_id);
                    }
                    Alert::success('Success','Welcome '.$data->name);
                    if($data->role == 'master'){
                        return redirect('pantlot');
                    }
                    elseif($data->role == 'admin'){
                        return redirect('dashboard');
                    }
                    elseif($data->role != 'employee'){
                        return redirect(route('lotcard'));
                    }
                    elseif($data->role == 'employee'){
                        return redirect(route('lotcard'));
                    }
                    elseif($data->role == 'manager'){
                        return redirect('TrackPant');
                    }
                    elseif($data->role == 'cashier'){
                        return redirect('cashier_payments');
                    }
            }
            elseif($data != ''){
                    session()->put('nologin','Wrong Password — Contact Admin For access TPIS!');
                    return view('login');
            }
            else{
                    session()->put('nologin','User Not Exist — Contact Admin For access TPIS!');
                    return view('login');
            }
       }
       else{
            session()->put('nologin','Your Status is Disable — Contact Admin For access TPIS!');
            return view('login');
       }
    }
    public function EmpTable(Request $req){
        $data = register::all();
        return view('dashboard.emptable',['data'=>$data]);
    }
    public function ViewEmp($id){
        $data = register::where('user_id',$id)->first();
        return view('dashboard.viewemp',compact('data'));
    }

    public function EditEmp($id){
        $data = register::where('user_id',$id)->first();
        return view('dashboard.editemp',compact('data'));
    }

     public function update(Request $req)
     {
        try {
            $data = register::where('user_id', $req->user_id)->first();
            $data->address = $req->address;
            $data->name = $req->name;
            $data->email = $req->email;
            $data->cnic = $req->cnic;
            $data->phone_no = $req->phonenumber;
            $data->bankAccountNumber = $req->bankAccountNumber;
            $data->bankAccountName = $req->bankAccountName;
            $data->bankName = $req->bankName;
            $data->status = $req->status;
            if($req->has('salary')){
                $data->salary = $req->salary;
            }
            else{
                $data->fix_rate = $req->fix_rate;
            }
            
            if ($req->new_password != '') {
                $data->password = Hash::make($req->new_password);
            }
            
            if ($data->save()) {
                session()->put('success', 'User Updated Successfully');
            } else {
                session()->put('error', 'User Not Updated Successfully');
            }
        } catch (\Exception $e) {
            session()->put('error', 'An error occurred: ' . $e->getMessage());
        }
        
        return redirect(route('Emptable'));
     }
     public function parties(Request $req)
     {
        $data = register::all();
        return view('parties.parties',['data'=>$data]);
     }
     public function deleteemp(Request $req)
     {
        $data = register::where('user_id',$req->user_id)->first();
        if($data->delete()){
            Alert::success('Success',$data->name.' Record Deleted');
        }
        else{
            session()->put('error','Something Wrong to Delete the Record!');
        }
        return redirect()->back();
     }
     public function getFixRate($id)
    {
        $user = register::find($id);

        if ($user) {
            $fixRate = $user->fix_rate;
            if($fixRate == ''){
                $fixRate = 0;
            }
            return response()->json(['fix_rate' => $fixRate]);
        }

        return response()->json(['fix_rate' => null]); // Handle the case when the user is not found
    }
}

