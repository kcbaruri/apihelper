<?php

namespace App\Http\Controllers\Admin;

use App\Models\Vatatype;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use PDF;
class VatatypeController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Vatatype::orderBy('name', 'asc');

        $vatatypes =  $query->get();
        if($request->search == "download") {

        /*$pdf = PDF::setOptions(['dpi' => 150, 'defaultFont' => 'SolaimanLipi', 'defaultPaperSize' => 'a4'])->loadView('admin.vatatypes.vatatype_report', compact('vatatypes'));*/
        $pdf = PDF::loadView('admin.vatatypes.vatatype_report', compact('vatatypes'));
        return $pdf->download('vata_type.pdf')->header('Content-Type','application/pdf');
        } else {
        $departments = Department::where('status','=', 1)->get();
        return view('admin.vatatypes.index', compact('vatatypes', 'departments'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::where('status','=',1)->orderBy('name', 'asc')->get();
        return view('admin.vatatypes.create', compact('departments'));
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
            'department_id' => ['required', 'integer']
        ])->validate();
        
        try {
            $vata = Vatatype::create([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'department_id' => $request->input('department_id'),
                'status' => $request->input('status')
            ]);

        } catch (\Exception $e) {
            //dd($e);
            return redirect()->back()->withErrors("Something went wrong");
        }

        return redirect()->route('admin.vatatypes')->with('success', "Successfully created Vata Type");
    }

    /**


     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vatatype = Vatatype::find($id);
        return view('admin.vatatypes.show')->with(compact( 'vatatype'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $vatatype = Vatatype::find($id);
        $departments = Department::where('status','=',1)->orderBy('name', 'asc')->get();
        return view('admin.vatatypes.edit')->with(compact( 'vatatype', 'departments'));
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
            $vatatype = Vatatype::find($id);

            if($vatatype == null)
                return redirect()->back()->withErrors("Vata Type Not Found");

            $vatatype->name = $request->input('name');
            $vatatype->description = $request->input('description');
            $vatatype->department_id = $request->input('department_id');
            $vatatype->status = $request->input('status');
            $vatatype->save();

     
        } catch (\Exception $e) {
            return redirect()->back()->withErrors("Something went wrong");
        }

        return redirect()->route('admin.vatatypes')
                         ->with('success', "Vata type has been modified successfully.");
    }

    public function delete($id)
    {
        try {
            
            $vatatype = Vatatype::find($id);
            $vatatype->delete();
            return redirect()->back()->with('success', 'Successfully deleted Vata Type.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Something went wrong!');
        }
    }
}
