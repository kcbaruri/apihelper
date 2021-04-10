<?php

namespace App\Http\Controllers\Admin;

use App\Models\Floor;
use App\Models\Admin;
use App\Models\FlatOwner;
use App\Models\Tenant;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class FlatOwnerController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = new FlatOwner();
        $flatowners = $query->orderBy('name', 'ASC')->get();
        return view('admin.flatowners.index', compact('flatowners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.flatowners.create');
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
            'dob' => ['required'],
            //'profession_id' => 'required|numeric|gt:0',
            //'mobile_number' => 'required|string',
           // 'nid' => ['required','numeric','unique:tenants'],
        ])->validate();
        
        try {
                $flatowner = FlatOwner::create([
                    'name' => $request->input('name'),
                    'photo' => '',
                    'dob' => date('Y-m-d',strtotime($request->input('dob'))),
                    'gender' => $request->input('gender'),
                    'nid' => $request->input('nid'),
                    'blood_group' => $request->input('blood_group'),
                    'profession_id' => $request->input('profession_id'),
                    'religion' => $request->input('religion'),
                    'mobile_number' => $request->input('mobile_number'),
                    'email' => $request->input('email'),
                    'permanent_address' => $request->input('permanent_address'),
                    'profession_id' => $request->input('profession_id'),
                    'created_by' => Admin::find(auth('admin')->user()->id)->id
                ]);

                $flatowner->photo = $this->uploadFiles($request,'images/', $flatowner->id);
                $flatowner->save();
            }
        catch (\Exception $e) {
            dd($e);
            return redirect()->back()->withErrors("Something went wrong");
        }

        return redirect()->route('admin.flatowners', ['flatowner'=>$flatowner])->with('success', "Flat owner has been created successfully.");
    }

    /**


     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $flatowner = FlatOwner::find($id);
        return view('admin.flatowners.view')->with(compact( 'flatowner'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $flatowner = FlatOwner::find($id);
        return view('admin.flatowners.edit')->with(compact( 'flatowner'));
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
            'gender' => ['required'],
            'nid' => ['required','string'],
            'dob' => ['required'],
            'blood_group' => 'required|string',
            'religion' => 'required|numeric|gt:0',
            'permanent_address' => 'required|string'
        ])->validate();

        try {
            $flatowner = FlatOwner::find($id);

            if($flatowner == null)
                return redirect()->back()->withErrors("Flat owner was not found");

            $flatowner->name = $request->input('name');
            $flatowner->photo= '';
            $flatowner->dob = date('Y-m-d',strtotime($request->input('dob')));
            $flatowner->gender = $request->input('gender');
            $flatowner->nid = $request->input('nid');
            $flatowner->blood_group = $request->input('blood_group');
            $flatowner->profession_id = $request->input('profession_id');
            $flatowner->religion = $request->input('religion');
            $flatowner->mobile_number = $request->input('mobile_number');
            $flatowner->email = $request->input('email');
            $flatowner->permanent_address = $request->input('permanent_address');
            $flatowner->profession_id = $request->input('profession_id');
            $flatowner->created_by = Admin::find(auth('admin')->user()->id)->id;

            $flatowner->photo = $this->uploadFiles($request,'images/', $flatowner->id);
            $flatowner->save();
     
        } catch (\Exception $e) {
            return redirect()->back()->withErrors("Something went wrong");
        }

        return redirect()->route('admin.flatowners')
                         ->with('success', "Successfully updated the owner");
    }

    public function delete($id)
    {
        try {
            
            $flatowner = FlatOwner::find($id);
            $flatowner->delete();
            return redirect()->back()->with('success', 'Flat owner has been removed successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Something went wrong!');
        }
    }

    
}
