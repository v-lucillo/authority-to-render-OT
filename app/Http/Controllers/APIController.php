<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;


class APIController extends Controller
{

    public function registration(){
        return view('registration');
    }

    public function login(Request $request){
        $data =  $request->all();
        $email = $data['email'];
        $user =  DB::select("SELECT * FROM user_tbl WHERE email = '$email'");

        if(!$user){
            throw ValidationException::withMessages(['login_error' => 'Invalid login credential']);
        }
        $password =  $user[0]->password;
        if($password != $data['password']){
            throw ValidationException::withMessages(['login_error' => 'Invalid login credential']);
        }
        session([
            "user" => $user[0]
        ]);

        if($user[0]->user_lvl == 1 || $user[0]->user_lvl == 2 || $user[0]->user_lvl == 3){
                return redirect()->route('heads.home');
        }else if($user[0]->user_lvl == 4){
            return redirect()->route('admin.create_department');
        }
        return redirect()->route('user.file_ot');
    }

    public function sign_up(Request $request){
        $data =  $request->all();
        unset($data['_token']);
        $request->validate([
            "first_name" => "required",
            "last_name" => "required",
            "email" => "required",
            "restday" => "required",
            "time_in" => "required",
            "time_out" => "required",
            "phone" => "required",
            "password" => "confirmed|required",
            "department" => "required",
            "signature" => "mimes:jpg,bmp,png",
        ]);

        $signature_file = $request->file('signature');
        $filename = time().$signature_file->getClientOriginalName();
        $signature_file->move('uploads',$filename );
        $file_path = 'uploads/'.$filename;

        $data['signature'] = $file_path;
        unset($data['password_confirmation']);
        DB::table("user_tbl")->insert($data);

        return redirect()->route("sign_in")->with([
            "message" => "Success"
        ]);
    }

}
