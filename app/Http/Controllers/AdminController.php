<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Yajra\DataTables\Facades\DataTables;
use App\USERModel;
use Illuminate\Validation\ValidationException;


class AdminController extends Controller
{
    public function create_department(){
        return view("admin-pages.create_department");
    }

    public function submit_department(Request $request){
        $data = $request->all();
        $request->validate([
            "department" => "required"
        ]);
        unset($data['_token']);
        DB::table("department_tbl")->insert($data);

        return back()->with([
            "message" => "okay"
        ]);
    }

    public function get_department(){
        return DataTables::of(
            DB::select("SELECT * FROM department_tbl")
        )->make(true);
    }

    public function create_head_account(){
        return view('admin-pages.create_head_account');
    }

    public function get_department_lov(Request $request){
        $q =  $request->q;
        if($q){
            return response()->json([
                "results" => DB::select("SELECT id, department as text FROM department_tbl WHERE department LIKE '%$q%'")
            ]);
        }
        
        return response()->json([
            "results" => DB::select("SELECT id, department as text FROM department_tbl")
        ]);
    }

    public function submit_dept_head_create(Request $request){
        $data = $request->all();
        $request->validate([
            "first_name" => "required",
            "last_name" => "required",
            "email" => "required|unique:user_tbl,email",
            "user_lvl" => "required",
            "signature" => "mimes:jpg,bmp,png|required",
            "password" => "required"
        ]);

        $signature_file = $request->file('signature');
        $filename = time().$signature_file->getClientOriginalName();
        $signature_file->move('uploads',$filename );
        $file_path = 'uploads/'.$filename;
        $data['signature'] = $file_path;

        $user = new USERModel;
        $user->first_name =  $data['first_name'];
        $user->last_name =  $data['last_name'];
        $user->email =  $data['email'];
        $user->user_lvl =  $data['user_lvl'];
        $user->password =  $data['password'];
        $user->signature =  $data['signature'];
        $user->save();
        $user_id = $user->id;

        $department = [];

        if(isset($data['department'])){
            foreach($data['department'] as $row){
                array_push($department,["user_id" => $user_id, "department_id" => $row]);
            }
            DB::table('department_handle_tbl')->insert($department);
        }

        return back()->with([
            "message" => "Oky"
        ]);
    }


    public function get_head_account(){
        return DataTables::of(
            DB::select("SELECT id ,CONCAT(first_name,' ',last_name) as name, email FROM user_tbl WHERE user_lvl <> 0")
        )->make(true);
    }

    public function edit_head_account(Request $request){
        $id =  $request->ajkld9123asdb123;
        $department =  DB::select("SELECT a.department_id, b.department FROM department_handle_tbl a LEFT JOIN department_tbl b on a.department_id = b.id WHERE user_id =  $id");
        return view('admin-pages.edit_head_account',compact('id','department'));
    }


    public function change_head_password(Request $request){
        $new_password =  $request->password;
        $id =  $request->id;
        $request->validate([
            "password" => "required"
        ]);

        DB::table("user_tbl")->where("id", $id)->update([
            "password" => $new_password
        ]);

        return back()->with([
            "message" => "Passwor Changed!"
        ]);
    }


    public function change_head_department(Request $request){
        $data =  $request->all();
        $department = [];
        DB::table("department_handle_tbl")->where("user_id", $data['id'])->delete();
        if(isset($data['department'])){
            foreach($data['department'] as $row){
                array_push($department,["user_id" => $data['id'], "department_id" => $row]);
            }
            // dd($department);
            DB::table('department_handle_tbl')->insert($department);
        }else{
            throw ValidationException::withMessages(['department' => 'Select atleast 1 department']);
        }

        return back()->with([
            "message" => "Assignatory assigned department updated!"
        ]);

    }
}
