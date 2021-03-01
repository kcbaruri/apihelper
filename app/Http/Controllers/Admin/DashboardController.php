<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\User;
use App\Models\Floor;
use App\Models\BillHead;
use App\Models\Admin;
use App\Models\Tenant;
use App\Models\Flat;
use App\Http\Controllers\Controller;



class DashboardController extends Controller
{
    public function index(){
    	
    	$admins = Admin::all();  
    	$tenants = Tenant::where('is_master','=',1)->orderBy('floor_id', 'asc')->get();
    	$floors = Floor::all();
		$billheads = BillHead::all();
		$flats = Flat::all();
    	return view('admin.dashboard', compact('admins','tenants','floors','billheads', 'flats'));
    }
}
