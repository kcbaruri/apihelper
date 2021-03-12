<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tenant;
use App\Models\Admin;
use App\Models\BillHead;
use App\Models\Bill;
use DB;

class BillController extends Controller
{
    public function __construct()
    {
       // $this->middleware(IsAdmin::class);
    }

    public function list()
    {
        $sqlCommand = DB::table('monthly_bills')
        ->leftJoin('tenants', 'monthly_bills.tenant_id', '=', 'tenants.id')
        ->select('monthly_bills.*', 'tenants.id', 'tenants.name');

        $sqlCommand->where('monthly_bills.billing_year', '=', date("Y"));
        $sqlCommand->where('monthly_bills.billing_month', '=', date("m"));
       

        $generatedBills = $sqlCommand->orderBy('tenants.id', 'ASC')->get();

      
       
        return $generatedBills::paginate();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.bills.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $familyHeads = Tenant::where('is_master', true)->pluck('name', 'id');
        $billHeads = BillHead::all();
        return view('bills.create', compact('familyHeads', 'billHeads'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $billHeads = BillHead::where('is_deleted', 0)->pluck('name', 'id');

        $bills = new Bill();
        foreach($billHeads as $key=>$name){
            if($key ==   1){
                $bills->col_1 = $request['col_1'];
            }
            else if($key ==   2){
                $bills->col_2 = $request['col_2'];
            }
            else if($key ==   3){
                $bills->col_3 = $request['col_3'];
            }
            else if($key ==   4){
                $bills->col_4 = $request['col_4'];
            }
            else if($key ==   5){
                $bills->col_5 = $request['col_5'];
            }
            else if($key ==   6){
                $bills->col_6 = $request['col_6'];
            }
            else if($key ==   7){
                $bills->col_7 = $request['col_7'];
            }
            else if($key ==   8){
                $bills->col_8 = $request['col_8'];
            }
            else if($key ==   9){
                $bills->col_9 = $request['col_9'];
            }
            else if($key ==   10){
                $bills->col_10 = $request['col_10'];
            }
            else if($key ==   11){
                $bills->col_11 = $request['col_11'];
            }
            else if($key ==   12){
                $bills->col_12 = $request['col_12'];
            }
            else if($key ==   13){
                $bills->col_13 = $request['col_13'];
            }
            else if($key ==   14){
                $bills->col_14 = $request['col_14'];
            }
            else if($key ==   15){
                $bills->col_15 = $request['col_15'];
            }
            else if($key ==   16){
                $bills->col_16 = $request['col_16'];
            }
            else if($key ==   17){
                $bills->col_17 = $request['col_17'];
            }
            else if($key ==   18){
                $bills->col_18 = $request['col_18'];
            }
            else if($key ==   19){
                $bills->col_19 = $request['col_19'];
            }
            else if($key ==   20){
                $bills->col_20 = $request['col_20'];
            }
            else if($key ==   21){
                $bills->col_21 = $request['col_21'];
            }
            else if($key ==   22){
                $bills->col_22 = $request['col_22'];
            }
            else if($key ==   23){
                $bills->col_23 = $request['col_23'];
            }
            else if($key ==   24){
                $bills->col_24 = $request['col_24'];
            }
            else if($key ==   25){
                $bills->col_25 = $request['col_25'];
            }
        }

       $bills->created_by = auth()->id();
       $bills->tenant_id = 1;// $request['tenant_id'];
       $bills->billing_month = 12;
       $bills->billing_year = 2020;
       $bills->is_deleted = 0;
        

       $bills->save();

       return view('bills.index');

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
}
