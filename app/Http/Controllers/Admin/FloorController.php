<?php

namespace App\Http\Controllers\Admin;

use App\Models\Floor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class FloorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $floors =  Floor::all();
        return view('admin.floors.index', compact('floors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.floors.create');
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
            $division = Floor::create([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'status' => $request->input('status')
            ]);

        } catch (\Exception $e) {
           // dd($e);
            return redirect()->back()->withErrors("Something went wrong");
        }

        return redirect()->route('admin.floors')->with('success', "Floor has been created suuccessfully.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ward  $ward
     * @return \Illuminate\Http\Response
     */
    public function show(Ward $ward)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ward  $ward
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $floor = Floor::find($id);
        return view('admin.floors.edit')->with(compact( 'floor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ward  $ward
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $floor = Floor::find($id);

            if($floor == null)
                return redirect()->back()->withErrors("Floor Was Not Found");

            $floor->name = $request->input('name');
            $floor->description = $request->input('description');
            $floor->id = $id;
            $floor->status = $request->input('status');
            $floor->save();

     
        } catch (\Exception $e) {
              dd($e);
            return redirect()->back()->withErrors("Something went wrong");
        }

        return redirect()->route('admin.floors')
                         ->with('success', "The floor has been modified successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ward  $ward
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        try {
            
            $floor = Floor::find($id);
            $floor->delete();
            return redirect()->back()->with('success', 'The floor has been removed successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Something went wrong!');
        }
    }
}
