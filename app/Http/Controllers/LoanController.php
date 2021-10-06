<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Loan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Validator;
use File;
use Session;
use Redirect;
class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['loans'] = DB::table( 'loans' )
        ->join( 'creditors', 'loans.cre_id', '=', 'creditors.id' )
        ->join( 'users', 'loans.user_id', '=', 'users.id' )
        ->select( 'loans.*', 'creditors.cre_first_Name' , 'creditors.cre_last_Name', 'users.user_first_Name', 'users.user_last_Name', 'creditors.cre_nic_number')
        ->where( [
            ['loans.status', '!=', 0],
        ] )
        ->get();
        return view( 'Admin.Loan.ViewLoans', $data );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    
        // $max_id=DB::table('users')->max('id');
        // $number = sprintf("%05d", $max_id+1);
        // $emp_number="EMP". $number;
        return view( 'Admin.Loan.CreateLoan' );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $creditor_nic = $request->get( 'creditor_nic' );
        $loan_amount = $request->get( 'loan_amount' );
        $loan_rental = $request->get( 'loan_rental' );
        $loan_period = $request->get( 'loan_period' );
        $loan_with_interest = $request->get( 'loan_with_interest' );
        $loan_installement = $request->get( 'loan_installement' );
        $loan_term = $request->get( 'loan_term' );
        $loan_start_date = $request->get( 'loan_start_date' );
        $cre_id = $request->get( 'cre_id');


        $validationdata = array( 'creditor_nic'=>$creditor_nic,'loan_amount' => $loan_amount, 'loan_period' => $loan_period, 'loan_installement' => $loan_installement, 'loan_term' => $loan_term, 'loan_start_date' => $loan_start_date, 'loan_rental' => $loan_rental );
        $validationtype = array( 'creditor_nic' => 'required','loan_amount' => 'required', 'loan_period' => 'required', 'loan_installement' => 'required', 'loan_term' => 'required', 'loan_start_date' => 'required|not_in:0|date|date_format:Y-m-d|after:yesterday', 'loan_rental' => 'required');

        $validator = Validator::make( $validationdata, $validationtype );

        if ( $validator->fails() ) {
            return redirect()->back()->withErrors( $validator )->withInput();
        }else{
            $number = sprintf("%05d", $loan_term);
            $loan_number= $cre_id."".$number+1;
            $data = [
                'loan_number' => $loan_number,
                'loan_amount' => $loan_amount,
                'loan_rental_freq' => $loan_rental,
                'loan_period' => $loan_period,
                'loan_with_int' => $loan_with_interest,
                'loan_installement' => $loan_installement,
                'loan_term' => $loan_term,
                'loan_start_date' => $loan_start_date,
                'user_id' => Session::get('user_info.id'),
                'created_at'=>\Carbon\Carbon::now()->toDateTimeString(),
                'updated_at'=>\Carbon\Carbon::now()->toDateTimeString(),
                'cre_id' => $cre_id,
                'status' => 1,
            ];

   


            $id = DB::table( 'loans' )->insertGetId( $data );
            $request->session()->flash( 'msg', 'insert' );

            return redirect( '/admin/createloan' );
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

        $loans = DB::table( 'loans' )
        ->join( 'creditors', 'loans.cre_id', '=', 'creditors.id' )
        ->select( 'loans.*', 'creditors.cre_first_Name', 'creditors.cre_last_Name', 'creditors.cre_nic_number', 'creditors.cre_phone_number', 'creditors.cre_address', 'creditors.id AS cre_id' )
        ->where( 'loans.id', $id )
        ->get()->first();

        return view( 'Admin.Loan.UpdateLoan', compact(  'loans' ) );
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
        $creditor_nic = $request->get( 'creditor_nic' );
        $loan_amount = $request->get( 'loan_amount' );
        $loan_rental = $request->get( 'loan_rental' );
        $loan_period = $request->get( 'loan_period' );
        $loan_with_interest = $request->get( 'loan_with_interest' );
        $loan_installement = $request->get( 'loan_installement' );
        $loan_term = $request->get( 'loan_term' );
        $loan_start_date = $request->get( 'loan_start_date' );
        $cre_id = $request->get( 'cre_id');


        $validationdata = array( 'creditor_nic'=>$creditor_nic,'loan_amount' => $loan_amount, 'loan_period' => $loan_period, 'loan_installement' => $loan_installement, 'loan_term' => $loan_term, 'loan_start_date' => $loan_start_date, 'loan_rental' => $loan_rental );
        $validationtype = array( 'creditor_nic' => 'required','loan_amount' => 'required', 'loan_period' => 'required', 'loan_installement' => 'required', 'loan_term' => 'required', 'loan_start_date' => 'required|not_in:0|date|date_format:Y-m-d|after:yesterday', 'loan_rental' => 'required');

        $validator = Validator::make( $validationdata, $validationtype );

        if ( $validator->fails() ) {
            return redirect()->back()->withErrors( $validator )->withInput();
        }else{
            $number = sprintf("%05d", $loan_term);
            $loan_number= $cre_id."".$number+1;
            $data = [
                'loan_number' => $loan_number,
                'loan_amount' => $loan_amount,
                'loan_rental_freq' => $loan_rental,
                'loan_period' => $loan_period,
                'loan_with_int' => $loan_with_interest,
                'loan_installement' => $loan_installement,
                'loan_term' => $loan_term,
                'loan_start_date' => $loan_start_date,
                'user_id' => Session::get('user_info.id'),
                'updated_at'=>\Carbon\Carbon::now()->toDateTimeString(),
                'cre_id' => $cre_id,
                'status' => 1,
            ];

   
            DB::table( 'loans' )->where( 'id', $id )->update( $data );
            $request->session()->flash( 'msg', 'update' );

            return redirect( '/admin/view_loan' );
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
        DB::table( 'loans' )->where( 'id', $id )->update( $data );

        $data['loans'] = DB::table( 'loans' )
        ->join( 'creditors', 'loans.cre_id', '=', 'creditors.id' )
        ->join( 'users', 'loans.user_id', '=', 'users.id' )
        ->select( 'loans.*', 'creditors.cre_first_Name' , 'creditors.cre_last_Name', 'users.user_first_Name', 'users.user_last_Name', 'creditors.cre_nic_number')
        ->where( [
            ['loans.status', '!=', 0],
        ] )
        ->get();
        return view( 'Admin.Loan.ViewLoans', $data );
    }
    public function searchcreditor(Request $request) {
        $search = $request->term;
        $students = DB::table('creditors')
                ->select('creditors.*')
                ->where([
                    ['cre_nic_number', 'LIKE', '%' . $search . '%'],
                    ['creditors.status', '=', 1],
                    ])
                ->get();
        $data = [];
        foreach ($students as $key => $value) {
            $data[] = ['id' => $value->id, 'value' => $value->cre_nic_number,
                    // 'cre_first_name'=>$value->cre_first_name,
                    'cre_gender'=>$value->cre_gender,
                    'cre_first_Name'=>$value->cre_first_Name,
                    'last_Name'=>$value->cre_last_Name,
                    'cre_phone_number'=>$value->cre_phone_number,
                    'cre_address'=>$value->cre_address,
            ];
        }
        return response($data);
    }
    public function loan_term(Request $request)
    {
        $msg;

        $count2 = \DB::table('loans')->where('cre_id', '<=', $request->cre_id)->count();

        // if (Loan::where('user_username', '=', $request->cre_id)->exists()) {
        //     $msg = 1;
        // } else {
        //     $msg = 0;
        // }
        return json_encode($count2);
    }
    public function getLoanById( $id ) {
        $data = DB::table( 'loans' )
        ->join( 'creditors', 'loans.cre_id', '=', 'creditors.id' )
        ->join( 'users', 'loans.user_id', '=', 'users.id' )
        ->select( 'loans.*', 'creditors.cre_first_Name' , 'creditors.cre_last_Name', 'users.user_first_Name', 'users.user_last_Name', 'creditors.cre_nic_number', 'creditors.cre_phone_number', 'creditors.cre_address')
        ->where( 'loans.id', $id )
        ->get();
        return response()->json( $data, 200 );
    }
    
}
