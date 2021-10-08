<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use App\Models\Creditor;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Validator;
use File;
use Session;
use Redirect;
class CreditorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['creditors'] = DB::table( 'creditors' )
        ->join( 'users', 'creditors.user_id', '=', 'users.id' )
        ->select( 'creditors.*', 'users.user_first_Name', 'users.user_last_Name' )
        ->where( [
            ['creditors.status', '=', 1],
        ] )
        ->orderBy('id', 'DESC')
        ->get();
        return view( 'Admin.Creditor.ViewCreditors', $data );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = DB::table( 'users' )
        ->select( 'users.*')
        ->where( 'users.role_id', 3)
        ->get();
        return view( 'Admin.Creditor.CreateCreditor',compact(  'users' ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cre_first_Name = $request->get( 'cre_first_Name' );
        $cre_last_Name = $request->get( 'cre_last_Name' );
        $cre_nic_number = $request->get( 'cre_nic_number' );
        $cre_DOB = $request->get( 'cre_DOB' );
        $cre_gender = $request->get( 'cre_gender' );
        $cre_phone_number = $request->get( 'cre_phone_number' );
        $cre_address = $request->get( 'cre_address' );
        $user_id = $request->get( 'user_id' );


        $validationdata = array( 'first_Name'=>$cre_first_Name,'last_Name' => $cre_last_Name, 'nic_number' => $cre_nic_number,  'DOB' => $cre_DOB, 'phone_number' => $cre_phone_number, 'address' => $cre_address, 'collector' => $user_id );
        $validationtype = array( 'first_Name' => 'required','last_Name' => 'required', 'nic_number' => 'required|max:12', 'DOB' => 'required|not_in:0|date|date_format:Y-m-d|before:yesterday', 'phone_number' => 'required|digits:10', 'address' => 'required', 'collector' => 'required' );

        $validator = Validator::make( $validationdata, $validationtype );

        if ( $validator->fails() ) {
            return redirect()->back()->withErrors( $validator )->withInput();
        } else {


            $data = [
                'cre_first_Name' => $cre_first_Name,
                'cre_last_Name' => $cre_last_Name,
                'cre_nic_number' => $cre_nic_number,
                'cre_DOB' => $cre_DOB,
                'cre_gender' => $cre_gender,
                'cre_phone_number' => $cre_phone_number,
                'cre_address' => $cre_address,
                'created_at'=>\Carbon\Carbon::now()->toDateTimeString(),
                'updated_at'=>\Carbon\Carbon::now()->toDateTimeString(),
                'user_id' => $user_id,
                'status' => 1,
            ];
            $time = time();
            if ( $request->hasFile( 'cre_image' ) ) {

                $image = $request->file( 'cre_image' );
                $imagename = $time . 'cfimg.' . $image->getClientOriginalExtension();
                $destinationPath = public_path( '/images/creditor/' );

                if ( !File::isDirectory( $destinationPath ) ) {
                    File::makeDirectory( $destinationPath, 0777, true, true );
                }

                $filename = $image->getClientOriginalName();
                $image_resize = \Image::make( $image->getRealPath() )->save( $destinationPath . $imagename );
                $data['cre_image'] = $imagename;

            }

            $id = DB::table( 'creditors' )->insertGetId( $data );
            $request->session()->flash( 'msg', 'insert' );

            return redirect( '/admin/addcreditor' );


        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = User::all();
        $creditors = DB::table( 'creditors' )
        ->join( 'users', 'creditors.user_id', '=', 'users.id' )
        ->select( 'creditors.*', 'users.user_first_Name', 'users.user_last_Name' )
        ->where( 'creditors.id', $id )
        ->get()->first();

        return view( 'Admin.Creditor.UpdateCreditor', compact( 'users', 'creditors' ) );

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
        $cre_first_Name = $request->get( 'cre_first_Name' );
        $cre_last_Name = $request->get( 'cre_last_Name' );
        $cre_nic_number = $request->get( 'cre_nic_number' );
        $cre_DOB = $request->get( 'cre_DOB' );
        $cre_gender = $request->get( 'cre_gender' );
        $cre_phone_number = $request->get( 'cre_phone_number' );
        $cre_address = $request->get( 'cre_address' );
        $user_id = $request->get( 'user_id' );
        // $id = $request->get( 'id' );

        $validationdata = array( 'first_Name'=>$cre_first_Name,'last_Name' => $cre_last_Name, 'nic_number' => $cre_nic_number,  'DOB' => $cre_DOB, 'phone_number' => $cre_phone_number, 'address' => $cre_address, 'collector' => $user_id );
        $validationtype = array( 'first_Name' => 'required','last_Name' => 'required', 'nic_number' => 'required|max:12', 'DOB' => 'required|not_in:0|date|date_format:Y-m-d|before:yesterday', 'phone_number' => 'required|digits:10', 'address' => 'required', 'collector' => 'required' );

        $validator = Validator::make( $validationdata, $validationtype );

        if ( $validator->fails() ) {
            return redirect()->back()->withErrors( $validator )->withInput();
        } else {

            $data = [
                'cre_first_Name' => $cre_first_Name,
                'cre_last_Name' => $cre_last_Name,
                'cre_nic_number' => $cre_nic_number,
                'cre_DOB' => $cre_DOB,
                'cre_gender' => $cre_gender,
                'cre_phone_number' => $cre_phone_number,
                'cre_address' => $cre_address,
                'created_at'=>\Carbon\Carbon::now()->toDateTimeString(),
                'updated_at'=>\Carbon\Carbon::now()->toDateTimeString(),
                'user_id' => $user_id,
                'status' => 1,
            ];
            $time = time();
            if ( $request->hasFile( 'cre_image' ) ) {

                $image = $request->file( 'cre_image' );
                $imagename = $time . 'cfimg.' . $image->getClientOriginalExtension();
                $destinationPath = public_path( '/images/creditor/' );

                if ( !File::isDirectory( $destinationPath ) ) {
                    File::makeDirectory( $destinationPath, 0777, true, true );
                }

                $filename = $image->getClientOriginalName();
                $image_resize = \Image::make( $image->getRealPath() )->save( $destinationPath . $imagename );
                $data['cre_image'] = $imagename;

            }else{
                $data['cre_image']=$request->get( 'cre_image1' );
            }

            DB::table( 'creditors' )->where( 'id', $id )->update( $data );
            $request->session()->flash( 'msg', 'update' );

            return redirect( '/admin/view_creditor' );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data['status']=0;
        DB::table( 'creditors' )->where( 'id', $id )->update( $data );

        $data['creditors'] = DB::table( 'creditors' )
        ->join( 'users', 'creditors.user_id', '=', 'users.id' )
        ->select( 'creditors.*', 'users.user_first_Name', 'users.user_last_Name' )
        ->where( [
            ['creditors.status', '=', 1],
        ] )
        ->get();
        return view( 'Admin.Creditor.ViewCreditors', $data );
    }
    public function searchcom(Request $request) {


        $search = $request->term;

        $students = DB::table('users')
                ->select('users.id', 'users.user_first_Name', 'users.user_last_Name')
                ->where([
                    ['user_first_Name', 'LIKE', '%' . $search . '%'],
                    ['users.role_id', '=', 3],
                    ])
                ->get();


        $data = [];

        foreach ($students as $key => $value) {
            $data[] = ['id' => $value->id, 'value' => $value->user_first_Name." ".$value->user_last_Name,
                    // 'blockNo'=>$value->blockNo,
            ];
        }
        return response($data);



    }
    public function check_nic(Request $request)
    {

        $msg;
        if (Creditor::where('cre_nic_number', '=', $request->nic_number)->exists()) {
            $msg = 1;
        } else {
            $msg = 0;
        }

        // return  $msg;

        return json_encode($msg);

    }public function getCreditorById( $id ) {
        $data = DB::table( 'creditors' )
        ->join( 'users', 'creditors.user_id', '=', 'users.id' )
        ->select( 'creditors.*', 'users.user_first_Name' , 'users.user_last_Name' )
        ->where( 'creditors.id', $id )
        ->get();

        return response()->json( $data, 200 );
    }
}
