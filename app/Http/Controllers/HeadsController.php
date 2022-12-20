<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Yajra\DataTables\Facades\DataTables;
use Barryvdh\DomPDF\Facade\Pdf;

class HeadsController extends Controller
{
    //

    public function home(){
        $user =  session("user");
        $user_id =  $user->id;
        $user_lvl = $user->user_lvl;
        if($user_lvl == 3){
            $employee =  DB::select("SELECT * FROM user_tbl WHERE user_lvl = 0");
        }else{
            $employee =  DB::select("SELECT * FROM user_tbl WHERE department IN (SELECT department_id FROM department_handle_tbl WHERE user_id = '$user_id')");
        }

        return view("heads-pages.home",compact('employee'));
    }

    public function ot(Request $request){
        $data = $request->all();
        $id = $data['sik123kasdh123iaasd'];
        $user =  session('user');
        $user_lvl = $user->user_lvl;
        return view("heads-pages.ot",compact('id','user_lvl'));
    }

    public function get_submitted_ot(Request $request){
        $employee_id =  $request->id;
        $stat =  $request->stat;
        $user = session("user");
        $user_lvl = $user->user_lvl;
        $user_id  = $user->id;
        $data = null;
        if($employee_id == 'view_all'){
            if($user_lvl == 3){
                $data =  DB::select("SELECT a.*, CONCAT(b.first_name,' ',b.last_name) as name FROM overtime_tbl a LEFT JOIN user_tbl b on a.user_id = b.id WHERE a.stat = $stat ORDER BY a.date ASC");
            }else{
                $data =  DB::select("SELECT a.*, CONCAT(b.first_name,' ',b.last_name) as name FROM overtime_tbl a LEFT JOIN user_tbl b on a.user_id = b.id WHERE a.stat = $stat AND department IN (SELECT department_id FROM department_handle_tbl WHERE user_id = $user_id) ORDER BY a.date ASC");
            }
        }else{
            if($user_lvl == 3){
                $data =  DB::select("SELECT a.*, CONCAT(b.first_name,' ',b.last_name) as name FROM overtime_tbl a LEFT JOIN user_tbl b on a.user_id = b.id WHERE b.id = $employee_id AND a.stat = $stat ORDER BY a.date ASC");
            }else{
                $data =  DB::select("SELECT a.*, CONCAT(b.first_name,' ',b.last_name) as name FROM overtime_tbl a LEFT JOIN user_tbl b on a.user_id = b.id WHERE b.id = $employee_id AND a.stat = $stat AND department IN (SELECT department_id FROM department_handle_tbl WHERE user_id = $user_id) ORDER BY a.date ASC");
            }
        }
        return DataTables::of($data)->make(true);

    }


    public function approved_and_sign_ot(Request $request){
        $data = $request->all();
        $user = session("user");
        // dd($data);
        if($data){
            if($user->user_lvl == 1){
                $date_signed = "lvl1_date_signed";
                $stat = 1;
            }else if($user->user_lvl == 2){
                $date_signed = "lvl2_date_signed";
                $stat = 2;
            }else {
                $date_signed = "lvl3_date_signed";
                $stat = 3;
            }

            foreach($data['ot'] as $ot){
              if($ot == null){
                  continue;
              }
              DB::table('overtime_tbl')->where('id', $ot['id'])->update([
                "stat" => $stat,
                $date_signed => date("Y-m-d H:i:s"),
              ]);
            }
        }

        if(sizeof($data) > 0){
            return response()->json([
                "message" => "Overtime Signed"
            ]);
        }
    }

    public function view_ot(Request $request){
        $ot_id =  $request->asdlasjkdhaskjdhasjkd;
        $data =  DB::select("SELECT a.*, CONCAT(b.first_name,' ',b.last_name) as name,b.phone, c.file_path, b.email FROM overtime_tbl a LEFT JOIN user_tbl b on a.user_id = b.id LEFT JOIN ot_attachment_tbl c on a.id = c.ot_id WHERE a.id = $ot_id");
        // dd($data);
        return view('heads-pages.view_ot',compact('data'));
    }

    public function generate_pdf(Request $request){
        $data = $request->all();
        $ot = array();
        $user_ids = [];
        $user_info = [];
        $user_assignatory =  [];
        $group_id =  date("Y-m-d")."-".$this->generateRandomString();
        foreach($data['ot'] as $row){
            $ot_id = $row['id'];
            $get_ot =  DB::select("SELECT a.*, CONCAT(b.first_name,' ', b.last_name) as name,
                b.restday,b.time_in, b.time_out, c.department, b.department as department_id, b.signature
                FROM overtime_tbl a
                LEFT JOIN user_tbl b on b.id = a.user_id
                LEFT JOIN department_tbl c on c.id = b.department
                WHERE a.id= $ot_id")[0];
            if(!in_array($get_ot->user_id, $user_ids)){
                $dept_id = $get_ot->department_id;
                array_push($user_ids,$get_ot->user_id);
                $asignatories =  DB::select("SELECT CONCAT(a.first_name,' ',a.last_name) as name, a.signature FROM user_tbl a
                    LEFT JOIN department_handle_tbl b on b.user_id = a.id
                    WHERE b.department_id = $dept_id");
                // dd($asignatories);
                $user_assignatory[$get_ot->user_id] = $asignatories;
                $user_info[$get_ot->user_id] = $get_ot;
            }
            array_push($ot,$get_ot);
            DB::table("overtime_tbl")->where("id",$ot_id)->update(['stat'=> 4]);
            DB::table("overtime_tbl")->where("id",$ot_id)->update(['group_id'=> $group_id ]);
        }

        $pdf = PDF::loadView('pdf.ot',compact('user_ids','ot','user_info','user_assignatory'));
        return $pdf->download();
    }


    private function generateRandomString($length = 5) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }


    public function change_password(){
        return view("heads-pages.change_password");
    }

    public function change_signature(){
        return view("heads-pages.change_signature");
    }


    public function submit_change_password(Request $request){
        $user =  session('user');
        $user_id = $user->id;
        $request->validate([
            "password" => "confirmed|required",
        ]);
        $password = $request->password;
        DB::table('user_tbl')->where('id', $user_id)->update([
            "password" => $password
        ]);

        return back()->with([
            "message" => "Password Changed!"
        ]);
    }


    public function submit_change_signature(Request $request){
        $user =  session('user');
        $user_id = $user->id;
        $request->validate([
            "signature" => "mimes:jpg,bmp,png|required",
        ]);

        $signature_file = $request->file('signature');
        $filename = time().$signature_file->getClientOriginalName();
        $signature_file->move('uploads',$filename );
        $file_path = 'uploads/'.$filename;


        DB::table('user_tbl')->where('id', $user_id)->update([
            "signature" => $file_path
        ]);

        return back()->with([
            "message" => "Signature updated!"
        ]);
    }

}
