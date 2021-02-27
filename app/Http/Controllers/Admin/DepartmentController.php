<?php

namespace App\Http\Controllers\Admin;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments =  Department::all();
        return view('admin.departments.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.departments.create');
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
            $division = Department::create([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'status' => $request->input('status')
            ]);

        } catch (\Exception $e) {
           // dd($e);
            return redirect()->back()->withErrors("Something went wrong");
        }

        return redirect()->route('admin.departments')->with('success', "Department has been created suuccessfully.");
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
        $department = Department::find($id);
        return view('admin.departments.edit')->with(compact( 'department'));
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
            $department = Department::find($id);

            if($department == null)
                return redirect()->back()->withErrors("Department Was Not Found");

            $department->name = $request->input('name');
            $department->description = $request->input('description');
            $department->id = $id;
            $department->status = $request->input('status');
            $department->save();

     
        } catch (\Exception $e) {
              dd($e);
            return redirect()->back()->withErrors("Something went wrong");
        }

        return redirect()->route('admin.departments')
                         ->with('success', "Successfully updated division");
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
            
            $department = Department::find($id);
            $department->delete();
            return redirect()->back()->with('success', 'Successfully deleted department.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Something went wrong!');
        }
    }
}
