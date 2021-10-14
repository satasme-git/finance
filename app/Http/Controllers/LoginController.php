<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Validator;
use Session;
use Redirect;

class LoginController extends Controller {
    public function loginValidate( Request $request ) {

        $user_username = $request->user_username;
        $user_password = $request->user_password;
        $validationdata = array( 'user_username' => $user_username, 'user_password' => $user_password );
        $validationtype = array( 'user_username' => 'required', 'user_password' => 'required' );

        $validator = Validator::make( $validationdata, $validationtype );

        if ( $validator->fails() ) {
            return redirect()->back()->withErrors( $validator )->withInput();
        } else {

            if ( $request->user_username != '' && $request->user_password != '' ) {
                $user = User::where( 'user_username', '=', $request->user_username )->first();
                if ( User::where( 'user_username', $request->user_username )->exists() ) {
                    if ( !empty( $user ) && Hash::check( $request->user_password, $user->user_password ) ) {
                        Session::put('user_username', $request->user_username);
                        Session::put('user_info', $user);
                        Session::put('role_id', $request->role_id);
                      
                        if(Session::get('user_info.role_id')==3){
                            return redirect( '/web/view_asign_loans' );
                        }else{
                            return redirect( '/dashboard' );
                        }
                        
                    } else {
                        $request->session()->flash('msg', '<div id="alert-msg" class="alert alert-danger">Password is incorrect <a class="close" data-dismiss="alert">×</a> </div>');
                        return redirect( '/' );
                    }

                } else {
                    $request->session()->flash('msg', '<div id="alert-msg"  class="alert alert-danger">Username & Password are incorrect <a class="close" data-dismiss="alert">×</a> </div>');
                        return redirect( '/' );
                }

            } else {

            }
        }
    }
    public function userlogout(Request $request){
		$request->session()->forget('user_email');
      
		return view('login');
	}
    public function profile(Request $request,$id){
   
        $users = DB::table( 'users' )
        ->join( 'roles', 'users.role_id', '=', 'roles.id' )
        ->select( 'users.*', 'roles.role_name' )
        ->where( 'users.id', $id )
        ->get()->first();
		return view('Admin.User.UpdateProfile', compact(  'users' ) );
	}
    public function fogotPassword()
    {
 
        return view( 'FogotPassword' );
    }
    public function resetPassword()
    {
 
        return view( 'ResetPassword' );
    }

    public function sendEmail(Request $request)
    {
        $email = $request->email;
        $validationdata = array( 'email' => $email);
        $validationtype = array( 'email' => 'required' );

        $validator = Validator::make( $validationdata, $validationtype );

        if ( $validator->fails() ) {
            return redirect()->back()->withErrors( $validator )->withInput();
        }else{

            $user = User::where( 'user_email', '=', $request->email )->first();
            if ( !empty( $user ) ) {

                $details=[
                    'title'=>'Mail form finance',
                    'body'=>'This is a testing email'
                ];
                Session::put('reset_email', $request->email);
                Mail::to($request->email)->send(new SendMail($details));
              return redirect( '/email_confirm' );;

                
            } else {
                $request->session()->flash('msg', '<div id="alert-msg" class="alert alert-danger">Email is incorrect <a class="close" data-dismiss="alert">×</a> </div>');
                return redirect( '/fogot_password' );
            }
        }
    }
    public function passwordReset(Request $request){

        $email_address = $request->email_address;
        $new_password = $request->new_password;
        $confirm_password = $request->confirm_password;
        $validationdata = array( 'email_address' => $email_address,'new_password' => $new_password,'confirm_password' => $confirm_password);
        $validationtype = array( 'email_address' => 'required','new_password' => 'required','confirm_password' => 'required' );

        $validator = Validator::make( $validationdata, $validationtype );

        if ( $validator->fails() ) {
            return redirect()->back()->withErrors( $validator )->withInput();
        }else{
            if($new_password==$confirm_password){
                $data = [
                    'user_password' => Hash::make($new_password ),
                    'updated_at'=>\Carbon\Carbon::now()->toDateTimeString(),
                ];
                DB::table( 'users' )->where( 'user_email', $email_address )->update( $data );
                return view('login');
            }else{
                $request->session()->flash('msg1', '<span class="help-block"><strong style="color: #ff0000">Password does not match</strong></span>');
                return redirect( '/reset_password' );
            }
        }
       
    }
    

    
}
