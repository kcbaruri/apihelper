<?php

namespace App\Http\Controllers\Admin;

use App\Models\Division;
use App\Models\District;
use App\Models\Thana;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use PDF;
class ThanaController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Thana::with('division','district')->where('status','!=','-1');
        if($request->division_id > 0){
            $query->where('division_id', '=', $request->input('division_id'));
        }

        if($request->district_id > 0){
            $query->where('district_id', '=', $request->input('district_id'));
        }

        $thanas =  $query->orderBy('name', 'ASC')->get();
        $divisions = Division::where('status','=', 1)->get();
        $districts = District::where('status','=', 1)->get();

        if($request->search == "download") {

        $pdf = PDF::loadView('admin.thanas.thana_report', compact('thanas'));
        return $pdf->download('thana.pdf')->header('Content-Type','application/pdf');
        } else {
        return view('admin.thanas.index', compact('thanas','divisions','districts'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $divisions = Division::where('status','=',1)->orderBy('name', 'asc')->get();
        $districts = District::where('status','=',1)->orderBy('name', 'asc')->get();

        return view('admin.thanas.create', compact('divisions','districts'));
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
            'division_id' => ['required', 'integer'],
            'district_id' => ['required', 'integer']
        ])->validate();
        
        try {
            $thana = Thana::create([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'district_id' => $request->input('district_id'),
                'division_id' => $request->input('division_id'),
                'status' => $request->input('status')
            ]);

        } catch (\Exception $e) {
            return redirect()->back()->withErrors("Something went wrong");
        }

        return redirect()->route('admin.thanas')->with('success', "Successfully created Upazila");
    }

    /**


     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $division = Division::find($id);
        return view('admin.divisions.show')->with(compact( 'division'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $thana = Thana::find($id);
        $divisions = Division::where('status','=',1)->orderBy('name', 'asc')->get();
        $districts = District::where('status','=',1)->orderBy('name', 'asc')->get();
        return view('admin.thanas.edit')->with(compact( 'thana','districts','divisions'));
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
            'division_id' => ['required', 'integer'],
            'district_id' => ['required', 'integer']
        ])->validate();

        try {
            $thana = Thana::find($id);

            if($thana == null)
                return redirect()->back()->withErrors("Upazila Not Found");

            $thana->name = $request->input('name');
            $thana->description = $request->input('description');
            $thana->division_id = $request->input('division_id');
            $thana->district_id = $request->input('district_id');
            $thana->status = $request->input('status');
            $thana->save();
     
        } catch (\Exception $e) {
            return redirect()->back()->withErrors("Something went wrong");
        }

        return redirect()->route('admin.thanas')->with('success', "Successfully updated Thana");
    }

    public function delete($id)
    {
        try {
            
            $thana = Thana::find($id);
            $thana->delete();
            return redirect()->back()->with('success', 'Successfully deleted Thana.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Something went wrong!');
        }
    }
}
