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
class CollectorController extends Controller
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
            ['creditors.user_id', '=', Session::get('user_info.id')],
        ] )
        ->orderBy('id', 'DESC')
        ->get();


        return view('Web.Collector.ViewAssignCreditors',$data );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Web.Collector.CreateDailyCollection' );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $loan_number = $request->get( 'loan_number' );
        $cre_id = $request->get( 'cre_id' );
        $loan_id = $request->get( 'loan_id' );
        $pay_amount = $request->get( 'pay_amount' );
        $outstanding = $request->get( 'outstanding' );
        

        $validationdata = array( 'loan_number'=>$loan_number,'pay_amount' => $pay_amount);
        $validationtype = array( 'loan_number' => 'required','pay_amount' => 'required', );

        $validator = Validator::make( $validationdata, $validationtype );

        if ( $validator->fails() ) {
            return redirect()->back()->withErrors( $validator )->withInput();
        }else{
            if($outstanding>=$pay_amount){
                $data = [
                    'loan_number' => $loan_number,
                    'pay_amount' => $pay_amount,
                    'installement_date' =>  \Carbon\Carbon::parse(\Carbon\Carbon::now()->toDateTimeString())->format('Y-m-d'),
                    'cre_id' => $cre_id,
                    'loan_id' => $loan_id,
                    'user_id' => Session::get('user_info.id'),
                    'created_at'=>\Carbon\Carbon::parse(\Carbon\Carbon::now()->toDateTimeString())->format('Y-m-d'),
                    'updated_at'=>\Carbon\Carbon::now()->toDateTimeString(),
                    'status' => 1,
                   
                ];
    
    
                $id = DB::table( 'daily_collections' )->insertGetId( $data );
                $request->session()->flash( 'msg', 'insert' );
    
                return redirect( '/web/daily_collection' );
            }else{
                $request->session()->flash('msg1', '<span class="help-block"><strong style="color: #ff0000">Pay amount must be lower or equal than oustanding amount</strong></span>');
                return redirect()->back();
            }
         
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function searchLoan(Request $request) {
        $search = $request->term;
        $students = DB::table('loans')
                ->join( 'creditors', 'loans.cre_id', '=', 'creditors.id' )
                ->select('loans.*', 'creditors.cre_first_Name' , 'creditors.cre_last_Name', 'creditors.cre_nic_number', 'creditors.cre_phone_number', 'creditors.cre_address', 'creditors.id AS cre_id')
                ->where([
                    ['loan_number', 'LIKE', '%' . $search . '%'],
                    ['creditors.user_id', '=', Session::get('user_info.id')],
                    ['loans.status', '=', 1],
                    ])
                ->get();
        $data = [];
        foreach ($students as $key => $value) {
            $data[] = ['id' => $value->id, 'value' => $value->loan_number,
                    // 'cre_first_name'=>$value->cre_first_name,
                    'cre_first_Name'=>$value->cre_first_Name,
                    'last_Name'=>$value->cre_last_Name,
                    'cre_phone_number'=>$value->cre_phone_number,
                    'cre_address'=>$value->cre_address,

                    'cre_id'=>$value->cre_id,
                    'loan_amount'=>$value->loan_amount,
                    'loan_rental_freq'=>$value->loan_rental_freq,
                    'loan_period'=>$value->loan_period,
                    'loan_with_int'=>$value->loan_with_int,
                    'loan_installement'=>$value->loan_installement,
            ];
        }
        return response($data);
    }
    public function loan_outstanding(Request $request)
    {
        $balance = DB::table('daily_collections')->where('loan_id', $request->loan_id)->sum('pay_amount');


 
        return json_encode($balance);
    }
       public function view_daily_collections(Request $request)
    {
        $ldate = date('Y-m-d');

        $data['collections'] = DB::table( 'daily_collections' )
        ->join( 'creditors', 'daily_collections.cre_id', '=', 'creditors.id' )
        ->select( 'daily_collections.*', 'creditors.cre_first_Name', 'creditors.cre_last_Name', 'creditors.cre_nic_number' )
        ->where( [
            ['daily_collections.status', '=', 1],
            ['daily_collections.installement_date', '=', $ldate],
        ] )
        ->orderBy('id', 'DESC')
        ->get();


        return view('Web.Collector.ViewDailyCollectionAdmin',$data );
    }
    public function searchCollector(Request $request) {
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
                    // 'cre_first_name'=>$value->cre_first_name,
                   
            ];
        }
        return response($data);
    }
        public function serch_by_collector_id(Request $request) {

            $ldate = date('Y-m-d');
            $collector_name = $request->search;
            $collector_id = $request->collector_id;
            
            
            
            $start_date = $request->start_date;
            $end_date = $request->end_date;
    
            $validationdata = array('search' => $collector_name);
            $validationtype = array('search' => 'required');
    
            $validator = Validator::make($validationdata, $validationtype);
            
            if ( $validator->fails() ) {
                return redirect()->back()->withErrors( $validator )->withInput();
            }else{
                        if($collector_id !=null&& $start_date==null or $end_date==null){
                            $data['collections'] = DB::table( 'daily_collections' )
                            ->join( 'creditors', 'daily_collections.cre_id', '=', 'creditors.id' )
                            ->join('users', 'daily_collections.user_id', '=', 'users.id')
                            ->select( 'daily_collections.*', 'creditors.cre_first_Name', 'creditors.cre_last_Name', 'creditors.cre_nic_number','users.user_first_Name','users.user_last_Name' )
                            ->where( [
                                ['daily_collections.status', '=', 1],
                                ['daily_collections.installement_date', '=', $ldate],
                                ['users.id', '=', $collector_id],
                            ] )
                            ->orderBy('id', 'DESC')
                            ->get();
                        }else if($collector_id !=null&& $start_date!=null && $end_date!=null){
                            $data['collections'] = DB::table( 'daily_collections' )
                            ->join( 'creditors', 'daily_collections.cre_id', '=', 'creditors.id' )
                            ->join('users', 'daily_collections.user_id', '=', 'users.id')
                            ->select( 'daily_collections.*', 'creditors.cre_first_Name', 'creditors.cre_last_Name', 'creditors.cre_nic_number','users.user_first_Name','users.user_last_Name' )
                            ->where( [
                                ['daily_collections.status', '=', 1],
                                ['users.id', '=', $collector_id],
                            ] )
                            ->whereBetween('daily_collections.installement_date', [$request->start_date, $request->end_date])
                            ->orderBy('id', 'DESC')
                            ->get();

                        }
                        return view('Web.Collector.ViewDailyCollectionAdmin',$data );

            }
 

        }
        public function daily_collection_by_nic(Request $request)
        {
            $data['loans']="";
            return view('Web.Collector.ViewCreditorByNIC',$data );


        } 
        public function searchloanbycreditor(Request $request) {
        
        $search = $request->term;
        $students = DB::table('creditors')
             
                ->select('creditors.*')
                ->where([
                    ['cre_nic_number', 'LIKE', '%' . $search . '%'],
                    ['status', '=', 1],
                    ['creditors.user_id', '=', Session::get('user_info.id')],
                    
                    ])
                ->get();
        $data = [];
        foreach ($students as $key => $value) {
            $data[] = ['id' => $value->id, 'value' => $value->cre_nic_number,
                    // 'user_id'=> $id,
                    
            ];
        }
        return response($data);

    }


    public function serch_by_creditor_nic(Request $request) {

      
        $creditor_nic = $request->search;
        $creditor_id = $request->creditor_id;
        
        // echo "dsasdasdasd".$creditor_nic." / ". $creditor_id;

        // $validationdata = array('search' => $creditor_nic);
        // $validationtype = array('search' => 'required');

        // $validator = Validator::make($validationdata, $validationtype);
        
        // if ( $validator->fails() ) {
        //     return redirect()->back()->withErrors( $validator )->withInput();
        // }
        // else{
                   
                        $data['loans'] = DB::table( 'loans' )
                        ->join( 'creditors', 'loans.cre_id', '=', 'creditors.id' )
                        ->select( 'loans.*', 'creditors.cre_first_Name', 'creditors.cre_last_Name', 'creditors.cre_nic_number')
                        ->where( [
                            ['loans.status', '=', 1],
                            ['creditors.id', '=', $creditor_id],
                        ] )
                        ->orderBy('id', 'DESC')
                        ->get();
                    
                    return view('Web.Collector.ViewCreditorByNIC',$data );

        // }


    }
    public function dailycollectionbyloan_id($id)
    
    {

        $data['balance'] = DB::table('daily_collections')->where('loan_id', $id)->sum('pay_amount');
        $collections = DB::table('loans')
                ->join( 'creditors', 'loans.cre_id', '=', 'creditors.id' )
                ->select('loans.*', 'creditors.cre_first_Name' , 'creditors.cre_last_Name', 'creditors.cre_nic_number', 'creditors.cre_phone_number', 'creditors.cre_address', 'creditors.id AS cre_id')
                ->where([
                    ['loans.id', '=',  $id],
                    ['loans.status', '=', 1],
                    ])
                ->get()->first();

        return view( 'Web.Collector.DailyCollectionByLoanNumber',$data,compact( 'collections'));

    }

    public function daily_collection_by_cre_id(Request $request)
    {


       $data['loans'] = DB::table( 'loans' )
       ->join( 'creditors', 'loans.cre_id', '=', 'creditors.id' )
       ->select( 'loans.*', 'creditors.cre_first_Name', 'creditors.cre_last_Name', 'creditors.cre_nic_number')
       ->where( [
           ['loans.status', '=', 1],
           ['creditors.id', '=', $request->id],
       ] )
       ->orderBy('id', 'DESC')
       ->get();
    
        return view('Web.Collector.ViewCreditorByNIC',$data );


    } 
    
    
}
