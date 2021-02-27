<?php

namespace App\Http\Controllers\Admin;

use App\Models\Division;
use App\Models\District;
use App\Models\Thana;
use App\Models\Union;
use App\Models\Village;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use PDF;
class VillageController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Village::with('division','district','thana','union')->where('status','!=','-1');

        if($request->division_id > 0){
            $query->where('division_id', '=', $request->input('division_id'));
        }

        if($request->district_id > 0){
            $query->where('district_id', '=', $request->input('district_id'));
        }

        if($request->thana_id > 0){
            $query->where('thana_id', '=', $request->input('thana_id'));
        }

        if($request->union_id > 0){
            $query->where('union_id', '=', $request->input('union_id'));
        }

        $villages =  $query->orderBy('name', 'ASC')->get();

        $divisions = Division::where('status','=', 1)->get();
        $districts = District::where('status','=', 1)->get();
        $thanas = Thana::where('status','=', 1)->get();
        $unions = Union::where('status','=', 1)->get();

        if($request->search == "download") {

        $pdf = PDF::loadView('admin.villages.village_report', compact('villages'));
        return $pdf->download('village.pdf')->header('Content-Type','application/pdf');
        } else {
        return view('admin.villages.index', compact('villages','unions','divisions','districts','thanas','districts'));
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
        $thanas = Thana::where('status','=',1)->orderBy('name', 'asc')->get();
        $unions = Union::where('status','=',1)->orderBy('name', 'asc')->get();

        return view('admin.villages.create', compact('divisions','districts','thanas','unions'));
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
            'district_id' => ['required', 'integer'],
            'thana_id' => ['required', 'integer'],
            'union_id' => ['required', 'integer']
        ])->validate();
        
        try {
            $village = Village::create([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'district_id' => $request->input('district_id'),
                'division_id' => $request->input('division_id'),
                'thana_id' => $request->input('thana_id'),
                'union_id' => $request->input('union_id'),
                'status' => $request->input('status')
            ]);

        } catch (\Exception $e) {
            return redirect()->back()->withErrors("Something went wrong");
        }

        return redirect()->route('admin.villages')->with('success', "Successfully created Village");
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
        $village = Village::find($id);
        $divisions = Division::where('status','=',1)->orderBy('name', 'asc')->get();
        $districts = District::where('status','=',1)->orderBy('name', 'asc')->get();
        $thanas = Thana::where('status','=',1)->orderBy('name', 'asc')->get();
        $unions = Union::where('status','=',1)->orderBy('name', 'asc')->get();
        return view('admin.villages.edit')->with(compact( 'village','unions','thanas','districts','divisions'));
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
            'district_id' => ['required', 'integer'],
            'thana_id' => ['required', 'integer'],
            'union_id' => ['required', 'integer']
        ])->validate();

        try {
            $village = Village::find($id);

            if($village == null)
                return redirect()->back()->withErrors("village Not Found");

            $village->name = $request->input('name');
            $village->description = $request->input('description');
            $village->division_id = $request->input('division_id');
            $village->district_id = $request->input('district_id');
            $village->thana_id = $request->input('thana_id');
            $village->union_id = $request->input('union_id');
            $village->status = $request->input('status');
            $village->save();
     
        } catch (\Exception $e) {
            return redirect()->back()->withErrors("Something went wrong");
        }

        return redirect()->route('admin.villages')->with('success', "Successfully updated Village");
    }

    public function delete($id)
    {
        try {
            
            $village = Village::find($id);
            $village->delete();
            return redirect()->back()->with('success', 'Successfully deleted village.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Something went wrong!');
        }
    }
}
