<?php

namespace App\Http\Controllers\Admin;

use App\Models\Division;
use App\Models\District;
use App\Models\Thana;
use App\Models\Union;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use PDF;
class UnionController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Union::with('division','district','thana')->where('status','!=','-1');
        if($request->division_id > 0){
            $query->where('division_id', '=', $request->input('division_id'));
        }

        if($request->district_id > 0){
            $query->where('district_id', '=', $request->input('district_id'));
        }

        if($request->thana_id > 0){
            $query->where('thana_id', '=', $request->input('thana_id'));
        }

        $unions =  $query->orderBy('name', 'ASC')->get();

        $divisions = Division::where('status','=', 1)->get();
        $districts = District::where('status','=', 1)->get();
        $thanas = Thana::where('status','=', 1)->get();

        if($request->search == "download") {

        $pdf = PDF::loadView('admin.unions.union_report', compact('unions'));
        return $pdf->download('union.pdf')->header('Content-Type','application/pdf');
        } else {
        return view('admin.unions.index', compact('unions','divisions','districts','thanas','districts'));
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

        return view('admin.unions.create', compact('divisions','districts','thanas'));
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
            'thana_id' => ['required', 'integer']
        ])->validate();
        
        try {
            $union = Union::create([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'district_id' => $request->input('district_id'),
                'division_id' => $request->input('division_id'),
                'thana_id' => $request->input('thana_id'),
                'status' => $request->input('status')
            ]);

        } catch (\Exception $e) {
            return redirect()->back()->withErrors("Something went wrong");
        }

        return redirect()->route('admin.unions')->with('success', "Successfully created Union");
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
        $union = Union::find($id);
        $divisions = Division::where('status','=',1)->orderBy('name', 'asc')->get();
        $districts = District::where('status','=',1)->orderBy('name', 'asc')->get();
        $thanas = Thana::where('status','=',1)->orderBy('name', 'asc')->get();
        return view('admin.unions.edit')->with(compact( 'union','thanas','districts','divisions'));
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
            $union = Union::find($id);

            if($union == null)
                return redirect()->back()->withErrors("Union Not Found");

            $union->name = $request->input('name');
            $union->description = $request->input('description');
            $union->division_id = $request->input('division_id');
            $union->district_id = $request->input('district_id');
            $union->thana_id = $request->input('thana_id');
            $union->status = $request->input('status');
            $union->save();
     
        } catch (\Exception $e) {
            return redirect()->back()->withErrors("Something went wrong");
        }

        return redirect()->route('admin.unions')->with('success', "Successfully updated Union");
    }

    public function delete($id)
    {
        try {
            
            $union = Union::find($id);
            $union->delete();
            return redirect()->back()->with('success', 'Successfully deleted union.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Something went wrong!');
        }
    }
}
