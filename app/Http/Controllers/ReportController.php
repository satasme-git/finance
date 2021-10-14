<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use App\Models\Loan;
use App\Models\Creditor;
use App\Models\DailyColection;

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
                        ->select(DB::raw("SUM(daily_collections.pay_amount) as payment_amount"),'daily_collections.id','daily_collections.loan_number', 'daily_collections.pay_amount', 'daily_collections.installement_date', 'daily_collections.status', 'daily_collections.cre_id', 'daily_collections.loan_id', 'creditors.cre_first_Name', 'creditors.cre_last_Name', 'creditors.cre_nic_number','users.user_first_Name','users.user_last_Name','loans.loan_amount','loans.loan_with_int','creditors.cre_nic_number','creditors.cre_first_Name','creditors.cre_last_Name','daily_collections.loan_id')
                        ->where( [
                            ['daily_collections.status', '=', 1],
                            // ['users.id', '=', $collector_id],
                        ] )
                        ->groupBy('daily_collections.loan_id')
                    
                        ->get();
                        return view('Web.Report.LoanOutstandingReport',$data );

    }
    public function outstanding_by_loan_id(Request $request) {

        $data['collections'] = DB::table( 'daily_collections' )
        ->join( 'creditors', 'daily_collections.cre_id', '=', 'creditors.id' )
        ->join( 'users', 'daily_collections.user_id', '=', 'users.id' )
        ->join( 'loans', 'daily_collections.loan_id', '=', 'loans.id' )
        ->select('daily_collections.*','creditors.cre_first_Name', 'creditors.cre_last_Name', 'creditors.cre_nic_number','users.user_first_Name','users.user_last_Name','loans.loan_amount','loans.loan_with_int','creditors.cre_nic_number','creditors.cre_first_Name','creditors.cre_last_Name')
        ->where( [
            ['daily_collections.loan_id', '=', $request->id],
            ['daily_collections.status', '=', 1],
        ] )
        ->get();

        return view('Web.Report.ViewOutstandingByLoanId',$data );

}
public function monthlyCollection() {

    $orders = Loan::select(
        DB::raw('sum(loan_with_int) as sums'), 
        DB::raw("DATE_FORMAT(created_at,'%M %Y') as months")
        )
        ->groupBy('months')
        ->get();

        $dailyCollections = DailyColection::select(
            DB::raw('sum(pay_amount) as pay_amount'), 
            DB::raw("DATE_FORMAT(created_at,'%M %Y') as monthsd")
            )
            ->groupBy('monthsd')
            ->get();

    // $date_year = date('Y-m', strtotime(\Carbon\Carbon::now()->toDateTimeString()));

    $data = [];

    foreach ($orders as $key => $value) {
        foreach ($dailyCollections as $key => $valued) {
            if($value->months==$valued->monthsd){
                $data[] = ['id' => $value->id, 'value' => $value->loan_number, 'sums' => $value->sums, 'months' => $value->months, 'pay_amount' => $valued->pay_amount,
                        // 'blockNo'=>$value->blockNo,
                ];
            }
        }
    }
   
    return response($data);


    // echo $orders;

}
    public function issuedLoanDaily() {
        $ldate = date('Y-m-d');
        $dailyCollections = Loan::select(
            DB::raw('sum(loan_amount) as loanamount'), 
            )
            ->where( [
                ['created_at', '=', $ldate],
            ] )
            ->get();

        $data = [];
        foreach ($dailyCollections as $key => $value) {
                $data[] = [ 'loanamount' => $value->loanamount];
        }
        
        return response($data);
    }
   
    public function todayDailyCollection() {
        $ldate = date('Y-m-d');
          $Collections = DailyColection::select(
                DB::raw('sum(pay_amount) as pay_amount'), 
                )
                ->where( [
                    ['installement_date', '=', $ldate],
                ] )
                ->get();
  
            
        $data = [];
        foreach ($Collections as $key => $value) {
                $data[] = [ 'pay_amount' => $value->pay_amount];
        }
        
        return response($data);
    }
    public function todayActiveCreditors() {
        $ldate = date('Y-m-d');
          $creditor = Creditor::select(
                DB::raw('count(id) as tota_Creditors'), 
                )
                ->where( [
                    ['status', '=', 1],
                ] )
                ->get();
  
            
        $data = [];
        foreach ($creditor as $key => $value) {
                $data[] = [ 'tota_Creditors' => $value->tota_Creditors];
        }
        
        return response($data);
    }

    
}
