<?php

namespace App\Http\Controllers\Admin;

use App\Models\Floor;
use App\Models\Admin;
use App\Models\Flat;
use App\Models\Tenant;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TenantController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = new Tenant();
        $tenants = $query->orderBy('name', 'ASC')->get();
        return view('admin.tenants.index', compact('tenants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $floors = Floor::pluck('name', 'id');
        $familyHeads = Tenant::where('is_master', true)->pluck('name', 'id');
        $flats = Flat::get();
        return view('admin.tenants.create', compact('floors', 'flats', 'familyHeads'));
    }


    private function getFamilyHeadInfo(Request $request){
        
        $tenant = Tenant::create([
            'is_master' => $request->input('is_master')]);

        return $tenant;
    }

    private function getFamilyMemberInfo(Request $request){
        dd("Family member");
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

        $tenant = new Tenant();
        
        try {
            
            if($request->input('is_master') == "on"){
                $tenant = Tenant::create([
                    'is_master' => 1,
                    'name' => $request->input('name'),
                    'photo' => '',
                    'is_flat_owner' => $request->input('is_flat_owner'),
                    'family_head_id' => $request->input('family_head_id'),
                    'floor_id' => $request->input('floor_id'),
                    'flat_id' => $request->input('flat_id'),
                    'dob' => date('Y-m-d',strtotime($request->input('dob'))),
                    'gender' => $request->input('gender'),
                    'nid' => $request->input('nid'),
                    'religion' => $request->input('religion'),
                    'notice_period_in_month' => $request->input('notice_period_in_month'),
                    'mobile_number' => $request->input('mobile_number'),
                    'email' => $request->input('email'),
                    'permanent_address' => $request->input('permanent_address'),
                    'profession_id' => $request->input('profession_id'),
                    'blood_group'=> $request->input('blood_group'),
                    'advance_amount' => $request->input('advance_amount'),
                    'user_id' => $request->input('user_id'),
                    'payment_due_date' => $request->input('payment_due_date'),
                    'in_date' => $request->input('in_date'),
                    'out_date' => $request->input('out_date'),
                    'no_of_family_members' => $request->input('no_of_family_members'),
                    'created_by' => Admin::find(auth('admin')->user()->id)->id
                ]);
            }
            else{
                $tenant = Tenant::create([
                    'is_master' => 0,
                    'name' => $request->input('name'),
                    'is_flat_owner' => 0,
                    'nid' => $request->input('nid'),
                    'family_head_id' => $request->input('family_head_id'),
                    'dob' => date('Y-m-d',strtotime($request->input('dob'))),
                    'gender' => $request->input('gender'),
                    'religion' => $request->input('religion'),
                    'blood_group'=> $request->input('blood_group'),
                    'created_by' => Admin::find(auth('admin')->user()->id)->id,
                    'mobile_number' => $request->input('mobile_number'),
                    'email' => $request->input('email'),
                ]);
            }

            $tenant->photo = $this->uploadFiles($request,'images/', $tenant->id);
            $tenant->save();
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->withErrors("Something went wrong");
        }

        return redirect()->route('admin.tenants', ['tenant'=>$tenant])->with('success', "Tenant has been created successfully.");
    }

    /**


     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tenant = Tenant::find($id);
        $floors = Floor::all();
        $familyheads = Tenant::where('is_master', true)->pluck('name', 'id');
        $flats = Flat::where('floor_id', $tenant->floor_id)->orderBy('name', 'asc')->get();
        return view('admin.tenants.view')->with(compact( 'tenant', 'floors', 'flats', 'familyheads'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $tenant = Tenant::find($id);
        $floors = Floor::all();
        $familyheads = Tenant::where('is_master', true)->pluck('name', 'id');
        $flats = Flat::where('floor_id', $tenant->floor_id)->orderBy('name', 'asc')->get();
        return view('admin.tenants.edit')->with(compact( 'tenant', 'floors', 'flats', 'familyheads'));
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
            'dob' => ['required'],
            //'profession_id' => 'required|numeric|gt:0',
            //'mobile_number' => 'required|string',
           // 'nid' => ['required','numeric','unique:tenants'],
        ])->validate();

        $tenant = Tenant::find($id);
        
        try {
            
            if($request->input('is_master') == "on"){
             
                $tenant->is_master = 1;
                $tenant->name = $request->input('name');
                $tenant->photo = '';
                $tenant->is_flat_owner = $request->input('is_flat_owner');
                $tenant->family_head_id = $request->input('family_head_id');
                $tenant->floor_id = $request->input('floor_id');
                $tenant->flat_id = $request->input('flat_id');
                $tenant->dob = date('Y-m-d',strtotime($request->input('dob')));
                $tenant->gender = $request->input('gender');
                $tenant->blood_group = $request->input('blood_group');
                $tenant->nid = $request->input('nid');
                $tenant->religion = $request->input('religion');
                $tenant->notice_period_in_month = $request->input('notice_period_in_month');
                $tenant->mobile_number = $request->input('mobile_number');
                $tenant->email = $request->input('email');
                $tenant->permanent_address = $request->input('permanent_address');
                $tenant->profession_id = $request->input('profession_id');
                $tenant->advance_amount = $request->input('advance_amount');
                $tenant->user_id = $request->input('user_id');
                $tenant->payment_due_date = $request->input('payment_due_date');
                $tenant->in_date = $request->input('in_date');
                $tenant->out_date = $request->input('out_date');
                $tenant->no_of_family_members = $request->input('no_of_family_members');
                $tenant->created_by = Admin::find(auth('admin')->user()->id)->id;
               
            }
            else{
                    $tenant->is_master = 0;
                    $tenant->name = $request->input('name');
                    $tenant->is_flat_owner = 0;
                    $tenant->nid = $request->input('nid');
                    $tenant->blood_group = $request->input('blood_group');
                    $tenant->family_head_id = $request->input('family_head_id');
                    $tenant->dob = date('Y-m-d',strtotime($request->input('dob')));
                    $tenant->gender = $request->input('gender');
                    $tenant->religion = $request->input('religion');
                    $tenant->created_by = Admin::find(auth('admin')->user()->id)->id;
                    $tenant->mobile_number = $request->input('mobile_number');
                    $tenant->email = $request->input('email');
            }

            $tenant->photo = $this->uploadFiles($request,'images/', $tenant->id);
            $tenant->save();
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->withErrors("Something went wrong");
        }

        return redirect()->route('admin.tenants', ['tenant'=>$tenant])->with('success', "Tenant has been modified successfully.");
    }

    public function delete($id)
    {
        try {
            
            $tenant = Tenant::find($id);
            $tenant->delete();
            return redirect()->back()->with('success', 'The tenant has been deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Something went wrong!');
        }
    }

    
}
