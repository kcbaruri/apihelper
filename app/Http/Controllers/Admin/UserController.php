<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Department;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $query = User::orderBy('id', 'DESC');
        
        if($request->name != null){
            $query->where('name', 'like', '%'.$request->name);
        }
        if($request->mobile_number != null){
            $query->where('mobile_number', 'like', '%'.$request->mobile_number);
        }
        $users = $query->get();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::where('status','=',1)->orderBy('name', 'asc')->get();
        return view('admin.users.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'user_name' => 'required',
            'department_id' => 'required|numeric|gt:0',
            'mobile_number' => ['required','digits:11','numeric','unique:users'],
            'password' => ['required', 'string'],
        ])->validate();

        $user_name_exist = User::where('user_name', '=', trim($request->user_name))->first();
        
        if($user_name_exist){
            return redirect()->back()->withInput()->withErrors('User Name already exists');
        }

        $user = new User();
        $user->name = $request->name;
        $user->user_name = $request->user_name;
        $user->email = $request->email;
        $user->mobile_number = $request->mobile_number;
        $user->password = Hash::make($request->password);
        //$user->image = $this->uploadFiles($request,'images/',auth()->user()->id);
        
        try{
            $user->save();            
        } catch (\Exception $e) {
            //dd($e);
            return redirect()->back()->withInput()->withErrors('Something went wrong!');
        }
        return redirect()->route('admin.users')->with('message', 'Patient added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(Dealer $dealer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Doctor $doctor
     * @return \Illuminate\Http\Response
     */
    public function edit($user_id)
    {
        
        $user_id = User::where('id', '=', $user_id)->first();
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Doctor $doctor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user_id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'user_name' => 'required',
            'mobile_number' => ['required','digits:11','numeric','unique:users'],
            'password' => ['required', 'string'],
        ])->validate();

        $user = User::find($user_id);
        $user->name = $request->name;
        $user->user_name = $request->user_name;
        $user->email = $request->email;
        $user->mobile_number = $request->mobile_number;

        if(!empty($request->password)) {
        $user->password = Hash::make($request->password);
        }
         
        try{
            $user->save();
        } catch (\Exception $e) {
            //dd($e);
            return redirect()->back()->withInput()->withErrors('Something went wrong!');
        }
        return redirect()->route('admin.users')->with('message', 'User Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Doctor $doctor
     * @return \Illuminate\Http\Response
     */
    public function delete($user_id)
    {
        try {
            $user = User::find($user_id);
            $delete = $user->delete();

            return redirect()->back()->with('message', 'User deleted Successfully');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Something went wrong!');
        }
    }

}
