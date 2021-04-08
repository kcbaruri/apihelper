<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Floor;
use App\Models\Flat;
use App\Models\Admin;
use App\Models\BillHead;
use App\Models\Bill;
use DB;
use PDF;

class BillController extends Controller
{
    public function __construct()
    {
       // $this->middleware(IsAdmin::class);
    }

   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $generatedbill = Bill::all();
        return view('admin.bills.index', compact('generatedbill'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $floors = Floor::all();
        $flats = Flat::where('1 == 2');
        $billheads = BillHead::all();
        return view('admin.bills.create', compact('floors', 'flats', 'billheads'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $billheads = BillHead::all();

        $bills = new Bill();
        foreach($billheads as $billhead){
            if($billhead->id ==   1){
                $bills->col_1 = $request['col_1'];
            }
            else if($billhead->id ==   2){
                $bills->col_2 = $request['col_2'];
            }
            else if($billhead->id ==   3){
                $bills->col_3 = $request['col_3'];
            }
            else if($billhead->id ==   4){
                $bills->col_4 = $request['col_4'];
            }
            else if($billhead->id ==   5){
                $bills->col_5 = $request['col_5'];
            }
            else if($billhead->id ==   6){
                $bills->col_6 = $request['col_6'];
            }
            else if($billhead->id ==   7){
                $bills->col_7 = $request['col_7'];
            }
            else if($billhead->id ==   8){
                $bills->col_8 = $request['col_8'];
            }
            else if($billhead->id ==   9){
                $bills->col_9 = $request['col_9'];
            }
            else if($billhead->id ==   10){
                $bills->col_10 = $request['col_10'];
            }
            else if($billhead->id ==   11){
                $bills->col_11 = $request['col_11'];
            }
            else if($billhead->id ==   12){
                $bills->col_12 = $request['col_12'];
            }
            else if($billhead->id ==   13){
                $bills->col_13 = $request['col_13'];
            }
            else if($billhead->id ==   14){
                $bills->col_14 = $request['col_14'];
            }
            else if($billhead->id ==   15){
                $bills->col_15 = $request['col_15'];
            }
            else if($billhead->id ==   16){
                $bills->col_16 = $request['col_16'];
            }
            else if($billhead->id ==   17){
                $bills->col_17 = $request['col_17'];
            }
            else if($billhead->id ==   18){
                $bills->col_18 = $request['col_18'];
            }
            else if($billhead->id ==   19){
                $bills->col_19 = $request['col_19'];
            }
            else if($billhead->id ==   20){
                $bills->col_20 = $request['col_20'];
            }
            else if($billhead->id ==   21){
                $bills->col_21 = $request['col_21'];
            }
            else if($billhead->id ==   22){
                $bills->col_22 = $request['col_22'];
            }
            else if($billhead->id ==   23){
                $bills->col_23 = $request['col_23'];
            }
            else if($billhead->id ==   24){
                $bills->col_24 = $request['col_24'];
            }
            else if($billhead->id ==   25){
                $bills->col_25 = $request['col_25'];
            }
            else if($billhead->id ==   26){
                $bills->col_26 = $request['col_26'];
            }
            else if($billhead->id ==   27){
                $bills->col_27 = $request['col_27'];
            }
            else if($billhead->id ==   28){
                $bills->col_28 = $request['col_28'];
            }
            else if($billhead->id ==   29){
                $bills->col_29 = $request['col_29'];
            }
        }

       $bills->created_by = 1; // auth()->id();
       $bills->is_deleted = 0;
       $bills->billing_month = $request['billing_month'];
       $bills->billing_year = $request['billing_year'];
       $bills->flat_id =  $request['flat_id'];
       $bills->floor_id =  $request['floor_id'];
       $bills->is_paid = 0;

       //dd($bills);
       $bills->save();

       return redirect()->route('admin.bills')->with('success', "Monthly bill has been generated successfully.");

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getFlatsByFloor($id)
    {
        $flats = Flat::where('floor_id',$id)->orderBy('name')->pluck('name','id');
        return json_encode($flats);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bills = Bill::find($id);
        $flats = Flat::where('floor_id','=', $bills->floor_id)->orderBy('name', 'asc')->get();
        $floors = Floor::where('status','=',1)->orderBy('name', 'asc')->get();
        $billheads = BillHead::all();
        return view('admin.bills.edit')->with(compact( 'flats','floors', 'bills', 'billheads'));
    }

    public function show($id)
    {
        $bills = Bill::find($id);
        $flats = Flat::where('floor_id','=', $bills->floor_id)->orderBy('name', 'asc')->get();
        $floors = Floor::where('status','=',1)->orderBy('name', 'asc')->get();
        $billheads = BillHead::all();
        return view('admin.bills.show')->with(compact( 'flats','floors', 'bills', 'billheads'));
    }

    public function download($id)
    {
        $billheads = BillHead::all();
        $billdetail = Bill::find($id);

        $pdf = PDF::loadView('admin.bills.individual_detail_report', compact('billheads', 'billdetail'));
        return $pdf->download('bill_detail.pdf')->header('Content-Type','application/pdf');
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
        $billheads = BillHead::all();
        $bills = Bill::find($id);
        

        foreach($billheads as $billhead){
            if($billhead->id ==   1){
                $bills->col_1 = $request['col_1'];
            }
            else if($billhead->id ==   2){
                $bills->col_2 = $request['col_2'];
            }
            else if($billhead->id ==   3){
                $bills->col_3 = $request['col_3'];
            }
            else if($billhead->id ==   4){
                $bills->col_4 = $request['col_4'];
            }
            else if($billhead->id ==   5){
                $bills->col_5 = $request['col_5'];
            }
            else if($billhead->id ==   6){
                $bills->col_6 = $request['col_6'];
            }
            else if($billhead->id ==   7){
                $bills->col_7 = $request['col_7'];
            }
            else if($billhead->id ==   8){
                $bills->col_8 = $request['col_8'];
            }
            else if($billhead->id ==   9){
                $bills->col_9 = $request['col_9'];
            }
            else if($billhead->id ==   10){
                $bills->col_10 = $request['col_10'];
            }
            else if($billhead->id ==   11){
                $bills->col_11 = $request['col_11'];
            }
            else if($billhead->id ==   12){
                $bills->col_12 = $request['col_12'];
            }
            else if($billhead->id ==   13){
                $bills->col_13 = $request['col_13'];
            }
            else if($billhead->id ==   14){
                $bills->col_14 = $request['col_14'];
            }
            else if($billhead->id ==   15){
                $bills->col_15 = $request['col_15'];
            }
            else if($billhead->id ==   16){
                $bills->col_16 = $request['col_16'];
            }
            else if($billhead->id ==   17){
                $bills->col_17 = $request['col_17'];
            }
            else if($billhead->id ==   18){
                $bills->col_18 = $request['col_18'];
            }
            else if($billhead->id ==   19){
                $bills->col_19 = $request['col_19'];
            }
            else if($billhead->id ==   20){
                $bills->col_20 = $request['col_20'];
            }
            else if($billhead->id ==   21){
                $bills->col_21 = $request['col_21'];
            }
            else if($billhead->id ==   22){
                $bills->col_22 = $request['col_22'];
            }
            else if($billhead->id ==   23){
                $bills->col_23 = $request['col_23'];
            }
            else if($billhead->id ==   24){
                $bills->col_24 = $request['col_24'];
            }
            else if($billhead->id ==   25){
                $bills->col_25 = $request['col_25'];
            }
            else if($billhead->id ==   26){
                $bills->col_26 = $request['col_26'];
            }
            else if($billhead->id ==   27){
                $bills->col_27 = $request['col_27'];
            }
            else if($billhead->id ==   28){
                $bills->col_28 = $request['col_28'];
            }
            else if($billhead->id ==   29){
                $bills->col_29 = $request['col_29'];
            }
        }

       $bills->created_by = 1; // auth()->id();
       $bills->is_deleted = 0;
       $bills->billing_month = $request['billing_month'];
       $bills->billing_year = $request['billing_year'];
       $bills->flat_id =  $request['flat_id'];
       $bills->floor_id =  $request['floor_id'];
       $bills->is_paid = 0;

      
       $bills->save();

       return redirect()->route('admin.bills')->with('success', "Monthly bill has been modified successfully.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        try {
            
            $bills = Bill::find($id);
            $bills->delete();
            return redirect()->back()->with('success', 'Selected bill has been removed successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Something went wrong!');
        }
    }
}
