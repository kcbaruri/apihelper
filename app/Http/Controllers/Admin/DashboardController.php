<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\User;
use App\Models\Vatahandover;
use App\Models\Vatatype;
use App\Models\Admin;
use App\Models\Citizen;
use App\Models\Union;
use App\Http\Controllers\Controller;



class DashboardController extends Controller
{
    public function index(){
    	
    	$admins = Admin::all();  
    	$citizens = Citizen::all();
    	$vatahandovers = Vatahandover::all();
		$vatatypes = Vatatype::all();
		$unions = Union::all();
    	return view('admin.dashboard', compact('admins','citizens','vatahandovers','vatatypes', 'unions'));
    }
}
