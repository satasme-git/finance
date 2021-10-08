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
class ReportController extends Controller
{
    public function view_loan_outstanding(Request $request) {


                        $data['collections'] = DB::table( 'daily_collections' )
                        ->join( 'creditors', 'daily_collections.cre_id', '=', 'creditors.id' )
                        ->join( 'users', 'daily_collections.user_id', '=', 'users.id' )
                        ->join( 'loans', 'daily_collections.loan_id', '=', 'loans.id' )
                        ->select(DB::raw("SUM(daily_collections.pay_amount) as payment_amount"),'daily_collections.id','daily_collections.loan_number', 'daily_collections.pay_amount', 'daily_collections.installement_date', 'daily_collections.status', 'daily_collections.cre_id', 'daily_collections.loan_id', 'creditors.cre_first_Name', 'creditors.cre_last_Name', 'creditors.cre_nic_number','users.user_first_Name','users.user_last_Name','loans.loan_amount','loans.loan_with_int','creditors.cre_nic_number','creditors.cre_first_Name','creditors.cre_last_Name')
                        ->where( [
                            ['daily_collections.status', '=', 1],
                            // ['users.id', '=', $collector_id],
                        ] )
                        ->groupBy('daily_collections.loan_id')
                    
                        ->get();
                        return view('Web.Report.LoanOutstandingReport',$data );

    }
}
