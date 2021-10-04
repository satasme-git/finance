<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
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
                        return redirect( '/dashboard' );
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
}
