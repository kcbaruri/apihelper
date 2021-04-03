<?php

namespace App\Http\Controllers\Admin;

use App\Models\Floor;
use App\Models\Flat;
use App\Models\FlatOwner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use PDF;

class FlatController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Flat::with('floor')->where('status','!=','-1') ;
        if($request->floor_id > 0){
            $query->where('floor_id', '=', $request->input('floor_id'));
        }

        $flats =  $query->orderBy('name', 'ASC')->get();

        $floors = Floor::where('status','=', 1)->get();
        if($request->search == "download") {

        $pdf = PDF::loadView('admin.flats.district_report', compact('flats'));
        return $pdf->download('flat.pdf')->header('Content-Type','application/pdf');
        } else {
        return view('admin.flats.index', compact('flats','floors'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $flatowners = FlatOwner::where('status','=',0)->orderBy('name', 'asc')->get();
        $floors = Floor::where('status','=',1)->orderBy('name', 'asc')->get();
        return view('admin.flats.create', compact('floors', 'flatowners'));
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
            'name' => ['required', 'string', 'max:255'],
            'floor_id' => ['required', 'integer']
        ])->validate();
        
        try {
            $flat = Flat::create([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'flat_owner_id' =>  $request->input('flat_owner_id'),
                'floor_id' => $request->input('floor_id'),
                'status' => $request->input('status')
            ]);

        } catch (\Exception $e) {
            return redirect()->back()->withErrors("Something went wrong");
        }

        return redirect()->route('admin.flats')->with('success', "Flat has been saved successfully.");
    }

    /**


     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $division = Floor::find($id);
        return view('admin.flats.show')->with(compact( 'floor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $query = new FlatOwner();
        $flat = Flat::find($id);
        $floors = Floor::where('status','=',1)->orderBy('name', 'asc')->get();
        $flatowners = $query->orderBy('name', 'ASC')->get();
        return view('admin.flats.edit')->with(compact( 'flat','floors', 'flatowners'));
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
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'floor_id' => ['required', 'integer'],
            'flat_owner_id' => ['required', 'integer']
        ])->validate();

        try {
            $flat = Flat::find($id);

            if($flat == null)
                return redirect()->back()->withErrors("Flat Not Found");

            $flat->name = $request->input('name');
            $flat->description = $request->input('description');
            $flat->floor_id = $request->input('floor_id');
            $flat->flat_owner_id = $request->input('flat_owner_id');
            $flat->status = $request->input('status');
            $flat->save();
     
        } catch (\Exception $e) {
            return redirect()->back()->withErrors("Something went wrong");
        }

        return redirect()->route('admin.flats')
                         ->with('success', "The flat has been modified successfully.");
    }

    public function delete($id)
    {
        try {
            
            $flat = Flat::find($id);
            $flat->delete();
            return redirect()->back()->with('success', 'Flat has been removed successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Something went wrong!');
        }
    }
}
