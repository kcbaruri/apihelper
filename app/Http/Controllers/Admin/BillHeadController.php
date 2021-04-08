<?php

namespace App\Http\Controllers\Admin;

use App\Models\BillHead;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use DB;

class BillHeadController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = BillHead::orderBy('name', 'asc');

        $billheads =  $query->get();
        return view('admin.billheads.index', compact('billheads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.billheads.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255']
        ])->validate();
        
        try {
            $billhead = BillHead::create([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'status' => $request->input('status')
            ]);

            $newColumnName = 'col_'.$billhead->id;
            DB::unprepared('ALTER TABLE monthly_bills ADD '.$newColumnName.'  double(8,2) NOT NULL DEFAULT 0.00;');

        } catch (\Exception $e) {
            //dd($e);
            return redirect()->back()->withErrors("Something went wrong");
        }

        return redirect()->route('admin.billheads')->with('success', "Bill head has been saved successfully.");
    }

    /**


     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $billhead = BillHead::find($id);
        return view('admin.billheads.show')->with(compact( 'billhead'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $billhead = BillHead::find($id);
        return view('admin.billheads.edit')->with(compact( 'billhead'));
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
        try {
            $billhead = BillHead::find($id);

            if($billhead == null)
                return redirect()->back()->withErrors("Bill Head Not Found");

            $billhead->name = $request->input('name');
            $billhead->description = $request->input('description');
            $billhead->status = $request->input('status');
            $billhead->save();

     
        } catch (\Exception $e) {
            return redirect()->back()->withErrors("Something went wrong");
        }

        return redirect()->route('admin.billheads')
                         ->with('success', "Bill head has been modified successfully.");
    }

    public function delete($id)
    {
        try {
            
            $billhead = BillHead::find($id);
            $billhead->delete();
            return redirect()->back()->with('success', 'Bill head has been removed successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Something went wrong!');
        }
    }
}
