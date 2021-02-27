<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Auth;

class AdminController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $not_authorized = "You are not authorized to access this page";
        if(Auth::guard('admin')->user()->user_type == "super-admin"){
       // $admins = Admin::all();

        $query = Admin::orderBy('name', 'asc');

        $admins =  $query->get();

        return view('admin.admin.index', compact('admins'));
        } else {
        return view('admin.admin.index', compact('not_authorized'));
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
        return view('admin.admin.create', compact('departments'));
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
            'department_id' => 'required|numeric|gt:0',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins'],
            'password' => ['required', 'string', 'min:6', 'confirmed']
        ])->validate();

       
        
        try {
            $user = Admin::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'department_id' => $request->input('department_id'),
                'password' => Hash::make($request->input('password')),
                'user_type' => $request->input('user_type'),
                'mobile' => $request->input('mobile'),
            ]);

        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->withErrors("Something went wrong");
        }

        return redirect()->route('admin.admin.index')
                         ->with('success', "Successfully created user");
    }

    /**


     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $admin = Admin::find($id);
        return view('admin.admins.show')->with(compact( 'admin'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $admin = Admin::find($id);
        $departments = Department::where('status','=',1)->orderBy('name', 'asc')->get();
        return view('admin.admin.edit')->with(compact( 'admin', 'departments'));
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
            $user = Admin::find($id);

            if($user == null)
                return redirect()->back()
                                 ->withErrors("User Not Found");

            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->department_id = $request->input('department_id');
            $user->password = $request->has('password') ? Hash::make($request->input('password')) : $user->password;
            $user->user_type = $request->input('user_type');
            $user->mobile = $request->input('mobile');

            $user->save();
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()
                             ->withErrors("Something went wrong");
        }

        return redirect()->route('admin.admin.index')
                         ->with('success', "Successfully updated user");
    }

    /**
     * [destroy description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     * @author Risul Islam <risul.islam@sslwireless.com><risul321@gmail.com>
     */
    public function destroy($id)
    {
        try {
            if(auth('admin')->user()->id == $id)
                return redirect()->back()->withErrors('You cannot delete current user!');

            $admin = Admin::find($id);
            $admin->delete();
            return redirect()->back()->with('success', 'Successfully deleted admin.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Something went wrong!');
        }
    }

    public function changePassword()
    {

        try {
            $admin = Admin::find(auth('admin')->user()->id);
            return view('admin.login.change-password')->with(compact( 'admin'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Something went wrong!');
        }
    }

    public function updatePassword(Request $request)
    {

        try {
            
            $user = Admin::find(auth('admin')->user()->id);

            if($user == null)
                return redirect()->back()->withErrors("User Not Found");

            if($request->new_password != $request->confirm_password)
                return redirect()->back()->withErrors("Password Not Same");

            $user->password = Hash::make($request->new_password);
            $user->save();
            return redirect()->route('admin.dashboard')->with('message', 'Password update Successfully');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Something went wrong!');
        }
    }
}
