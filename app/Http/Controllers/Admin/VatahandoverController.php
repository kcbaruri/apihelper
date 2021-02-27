<?php

namespace App\Http\Controllers\Admin;

use App\Models\Vatahandover;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class VatahandoverController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = Vatahandover::with('citizen')->orderBy('created_at', 'desc');
        $vatahandovers =  $query->get();
        return view('admin.vatahandovers.index', compact('vatahandovers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.vatatypes.create');
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
            $vata = Vatatype::create([
                'name' => $request->input('name'),
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
        $vatatype = Vatatype::find($id);
        return view('admin.vatatypes.edit')->with(compact( 'vatatype'));
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
            $vatatype->status = $request->input('status');
            $vatatype->save();

     
        } catch (\Exception $e) {
            return redirect()->back()->withErrors("Something went wrong");
        }

        return redirect()->route('admin.vatatypes')
                         ->with('success', "Successfully updated Vata Type");
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
