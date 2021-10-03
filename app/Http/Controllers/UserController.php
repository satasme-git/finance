<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Validator;
use File;
use Session;
use Redirect;
use Intervention\Image\ImageManagerStatic as Image;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
            $data['users'] = DB::table('users')
            ->join('roles', 'users.role_id', '=', 'roles.id')
            ->select('users.*', 'roles.role_name')
             ->where([
                ['users.status', '=', 1],
            ])
            ->get();
        return view('Admin.User.ViewUsers',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
    
        return view('Admin.User.CreateUser', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        echo "?>>>>>>>>>>>>>>>>>>>asppppppppppppppd>";
        // $user_first_Name = $request->get('fname');
        // $user_last_Name = $request->get('lname');
        // $user_email = $request->get('email');
        // $user_nic_number = $request->get('nic');
        // $user_DOB = $request->get('dob');
        // $user_phone_number = $request->get('mobile');
        // $user_username = $request->get('uname');

        // $user_address = $request->get('user_address');
        // $role_id = $request->get('role_id');
        // $id = $request->get('id');

        // $validationdata = array('user_first_Name' => $user_first_Name, 'user_last_Name' => $user_last_Name, 'user_email' => $user_email, 'user_nic_number' => $user_nic_number, 'user_DOB' => $user_DOB, 'user_phone_number' => $user_phone_number, 'user_username' => $user_username, 'user_address' => $user_address, 'role_id' => $role_id);
        // $validationtype = array('user_first_Name' => 'required', 'user_last_Name' => 'required', 'user_email' => 'required|email', 'user_nic_number' => 'required', 'user_DOB' => 'required|not_in:0|date|date_format:Y-m-d|before:yesterday','user_phone_number' => 'required|digits:10','user_username' => 'required','user_address' => 'required', 'role_id' => 'required');

        // $validator = Validator::make($validationdata, $validationtype);


        // if ($validator->fails()) {
        //     return redirect()->back()->withErrors($validator)->withInput();
        // } else {

        //     $data = [
        //         'user_first_Name' => $user_first_Name,
        //         'user_last_Name' => $user_last_Name,
        //         'user_email' => $user_email,
        //         'user_nic_number' => $user_nic_number,
        //         'user_DOB' => $user_DOB,
        //         'user_phone_number' => $user_phone_number,
        //         'user_username' => $user_username,
        //         'user_password' => Hash::make(123),
        //         'user_address' => $user_address,
        //         'role_id' => $role_id,
        //         'status' => 1,
        //     ];
        //     $time = time();
        //     if ($request->hasFile('user_image')) {

        //         $image = $request->file('user_image');
        //         $imagename = $time . 'cfimg.' . $image->getClientOriginalExtension();
        //         $destinationPath = public_path('/images/user/');

        //         if (!File::isDirectory($destinationPath)) {
        //             File::makeDirectory($destinationPath, 0777, true, true);
        //         }

        //         $filename = $image->getClientOriginalName();
        //         $image_resize = \Image::make($image->getRealPath())->save($destinationPath . $imagename);
        //         $data['user_image'] = $imagename;

        //     }
           
            
        //             $id = DB::table('users')->insertGetId($data);
        //             $request->session()->flash('msg', 'insert');
                
            
        //     return redirect('/admin/adduser');
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roles = Role::all();
        $users = DB::table('users')
        ->join('roles', 'users.role_id', '=', 'roles.id')
        ->select('users.*', 'roles.role_name')
        ->where('users.id', $id)
        ->get()->first();

        return view('Admin.User.UpdateUser', compact('roles','users'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        echo "?>>>>>>>>>>>>>>>>>>>asdasdasd>";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     
    }
    public function getUserById($id)
    {
        $data = DB::table('users')
        ->join('roles', 'users.role_id', '=', 'roles.id')
        ->select('users.*', 'roles.role_name')
        ->where('users.id', $id)
        ->get();

        return response()->json($data, 200);
    }
   

}
