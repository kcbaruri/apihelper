<?php

namespace App\Http\Controllers\Admin;

use App\Models\Division;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class DivisionController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = Division::orderBy('name', 'asc');

        $divisions =  $query->get();
        return view('admin.divisions.index', compact('divisions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.divisions.create');
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
            $division = Division::create([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'status' => $request->input('status')
            ]);

        } catch (\Exception $e) {
            //dd($e);
            return redirect()->back()->withErrors("Something went wrong");
        }

        return redirect()->route('admin.divisions')->with('success', "Successfully created Division");
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
        $division = Division::find($id);
        return view('admin.divisions.edit')->with(compact( 'division'));
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
            $division = Division::find($id);

            if($division == null)
                return redirect()->back()->withErrors("Division Not Found");

            $division->name = $request->input('name');
            $division->description = $request->input('description');
            $division->status = $request->input('status');
            $division->save();

     
        } catch (\Exception $e) {
            return redirect()->back()->withErrors("Something went wrong");
        }

        return redirect()->route('admin.divisions')
                         ->with('success', "Successfully updated division");
    }

    public function delete($id)
    {
        try {
            
            $division = Division::find($id);
            $division->delete();
            return redirect()->back()->with('success', 'Successfully deleted Division.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Something went wrong!');
        }
    }
}
