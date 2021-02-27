<?php

namespace App\Http\Controllers\Admin;

use App\Models\Division;
use App\Models\District;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use PDF;

class DistrictController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = District::with('division')->where('status','!=','-1');
        if($request->division_id > 0){
            $query->where('division_id', '=', $request->input('division_id'));
        }

        $districts =  $query->orderBy('name', 'ASC')->get();

        $divisions = Division::where('status','=', 1)->get();
        if($request->search == "download") {

        $pdf = PDF::loadView('admin.districts.district_report', compact('districts'));
        return $pdf->download('district.pdf')->header('Content-Type','application/pdf');
        } else {
        return view('admin.districts.index', compact('districts','divisions'));
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
        return view('admin.districts.create', compact('divisions'));
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
            'division_id' => ['required', 'integer']
        ])->validate();
        
        try {
            $district = District::create([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'division_id' => $request->input('division_id'),
                'status' => $request->input('status')
            ]);

        } catch (\Exception $e) {
            return redirect()->back()->withErrors("Something went wrong");
        }

        return redirect()->route('admin.districts')->with('success', "Successfully created Division");
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
        $district = District::find($id);
        $divisions = Division::where('status','=',1)->orderBy('name', 'asc')->get();
        return view('admin.districts.edit')->with(compact( 'district','divisions'));
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
            'division_id' => ['required', 'integer']
        ])->validate();

        try {
            $district = District::find($id);

            if($district == null)
                return redirect()->back()->withErrors("District Not Found");

            $district->name = $request->input('name');
            $district->description = $request->input('description');
            $district->division_id = $request->input('division_id');
            $district->status = $request->input('status');
            $district->save();
     
        } catch (\Exception $e) {
            return redirect()->back()->withErrors("Something went wrong");
        }

        return redirect()->route('admin.districts')
                         ->with('success', "Successfully updated district");
    }

    public function delete($id)
    {
        try {
            
            $district = District::find($id);
            $district->delete();
            return redirect()->back()->with('success', 'Successfully deleted District.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Something went wrong!');
        }
    }
}
