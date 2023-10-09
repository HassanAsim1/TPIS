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
        $data = new register;
        $checkdata = register::where('email',$req->email)->first();
        if($checkdata != ''){
            session()->put('error',$req->email. ' is already register.');
            return redirect()->back();
        }
        $data->address = $req->address;
        $data->name = $req->name;
        $data->email = $req->email;
        $data->password =Hash::make( $req->password);
        $data->working_area = $req->WorkingArea;
        if($req->salaryno=="")
        {
            $data->salary = "";
        }
        else{
            $data->salary = $req->salaryno;
        }
        if($req->fix_rate=="")
        {
            $data->fix_rate = "";
        }
        else{
            $data->fix_rate = $req->fix_rate;
        }

        $data->method_salary = $req->MethodofSalary;
        $data->role = $req->role;
        // if($req->role == 'admin'){
        //     $id = IdGenerator::generate(['table' =>'registers','field'=>'user_id', 'length' => 7, 'prefix' =>'ADM-']);
        //     $data->user_id= $id;
        // }
        // elseif($req->role == 'cashier'){
        //     $id = IdGenerator::generate(['table' =>'registers','field'=>'user_id', 'length' => 7, 'prefix' =>'CAS-']);
        //     $data->user_id= $id;
        // }
        // elseif($req->role == 'manager'){
        //     $id = IdGenerator::generate(['table' =>'registers','field'=>'user_id', 'length' => 7, 'prefix' =>'MAN-']);
        //     $data->user_id= $id;
        // }
        // elseif($req->role == 'master'){
        //     $id = IdGenerator::generate(['table' =>'registers','field'=>'user_id', 'length' => 7, 'prefix' =>'MAS-']);
        //     $data->user_id= $id;
        // }
        // else{
        $id = ['table' =>'registers','field'=>'user_id', 'length' => 7, 'prefix' =>'EMP-', 'reset_on_prefix_change' => true];
        $data->user_id= IdGenerator::generate($id);
        // }
        $data->cnic = $req->cnic;
        $data->phone_no = $req->phonenumber;
        $data->status = $req->status;
      //  $data->password = $req->password;
        //$data->save();
        if($data->save())
        {
            Alert::success('Success',$data->name.' Register Successful');
            if(session()->has('role') == 'admin')
            {
                return redirect('emptable');
            }
            else{
                return view('login');
            }
        }
        else{
            return redirect()->back();
        }
    }


    function login(Request $req)
    {
        $data = register::where('email',$req->email)->first();
    //    dd($data);
    // dd($data);
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
        $data = register::where('user_id',$req->user_id)->first();
        $data->address = $req->address;
        $data->name = $req->name;
        $data->email = $req->email;
        $data->cnic = $req->cnic;
        $data->phone_no = $req->phonenumber;
        $data->status = $req->status;
        if($req->new_password != ''){
            $data->password = Hash::make($req->new_password);
        }
        if($data->save()){
            session()->put('msg','User Updated Successfully');
        }
        else{
            session()->put('error','User Not Updated Successfully');
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

