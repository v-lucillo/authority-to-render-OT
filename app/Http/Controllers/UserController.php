<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OTModel;
use Storage;
use DB;
use Yajra\DataTables\Facades\DataTables;
use Barryvdh\DomPDF\Facade\Pdf;

class UserController extends Controller
{
    //

    public function home(){
        return view('user-pages.home');
    }

    public function file_ot(){
        return view('user-pages.file_ot');
    }

    public function submit_ot(Request $request){
        $data =  $request->all();
        unset($data['_token']);
        $request->validate([
            "date" => "required",
            "starting_time" => "required",
            "end_time" => "required",
            "task" => "required",
        ]);

        $ot = new OTModel;
        $ot->user_id =  session('user')->id;
        $ot->date =  $data['date'];
        $ot->starting_time =  $data['starting_time'];
        $ot->end_time =  $data['end_time'];
        $ot->task =  $data['task'];
        $ot->other_info =  $data['other_info'];
        $ot->save();
        $ot_id =  $ot->id;

        if(isset($data['attachment'])){
            if($data['attachment'][0] != null){
                $uploadedFile = $request->file('attachment');
                foreach($uploadedFile as $file){
                    $prefile = $this->generateRandomString();
                    $filename = $prefile.time().$file->getClientOriginalName();
                    $file->move('uploads',$filename );
                    $file_path = asset('uploads')."/".$filename;
                    DB::table("ot_attachment_tbl")->insert([
                        "ot_id" => $ot_id,
                        "file_path" => $file_path
                    ]);
                }
            }
        }

        return back()->with([
            "message" => "OT Submitted"
        ]);
    }


    public function ot_lvl1(Request $request){
        $user =  session('user');
        $user_id = $user->id;
        $stat =  $request->stat;
        return DataTables::of(
            DB::select("SELECT * FROM overtime_tbl WHERE stat  = $stat AND user_id = '$user_id' ")
        )->make(true);
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

    public function logout(){
        session()->flush();
        return redirect()->route('sign_in');
    }

    public function remove_ot(Request $request){
        $user =  session('user');
        $user_id = $user->id;
        $id =  $request->id;
        if(DB::table("overtime_tbl")->where(['user_id' => $user_id,'id' => $id])->select()){
            DB::table('ot_attachment_tbl')->where('ot_id',$id)->delete();
        }
        DB::table('overtime_tbl')->where(['user_id' => $user_id,'id' => $id])->delete();

        return response()->json([
            "message" => "okay"
        ]);
    }


    public function history(){
        return view('user-pages.history');
    }

    public function get_history_data(){
        $user =  session("user");
        $user_id =  $user->id;

        return DataTables::of(
            DB::select("SELECT DISTINCT group_id FROM overtime_tbl WHERE user_id = $user_id")
        )->make(true);
    }


    public function generate_pdf(Request $request){
        $group_id =  $request->group_id;
        $ot = array();
        $user_ids = [];
        $user_info = [];
        $user_assignatory =  [];
        $user_id =  session("user")->id;
        $data =  DB::select("SELECT * FROM overtime_tbl WHERE user_id = $user_id AND group_id = '$group_id'");
        foreach($data as $row){
            $ot_id = $row->id;
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
        }

        $pdf = PDF::loadView('pdf.ot',compact('user_ids','ot','user_info','user_assignatory'));
        return $pdf->download();
    }
}
