<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\User;
use App\Models\Floor;
use App\Models\BillHead;
use App\Models\Admin;
use App\Models\Tenant;
use App\Models\Flat;
use App\Models\Bill;
use App\Http\Controllers\Controller;

use Carbon\Carbon;



class DashboardController extends Controller
{
    public function index(){
		$search_term = "col_";
    	$admins = Admin::all();  
    	$tenants = Tenant::where('is_master','=',1)->orderBy('floor_id', 'asc')->get();
    	$floors = Floor::all();
		$billheads = BillHead::all();
		$flats = Flat::all();
		$billsInfo = Bill::where('billing_year','=',  Carbon::now()->year)->where('billing_month','=',  Carbon::now()->month)->get();
        $paidAmount = 0.0;
		$unpaidAmount = 0.0;

		foreach($billsInfo as $billsInfo){
			if($billsInfo->is_paid == 1){
				$paidAmount = $paidAmount + self::getCollectiveBill($billheads, $billsInfo);
			}
			else{
				$unpaidAmount =  $unpaidAmount + self::getCollectiveBill($billheads, $billsInfo);
			}
		}
		
    	return view('admin.dashboard', compact('admins','tenants','floors','billheads', 'flats', 'paidAmount', 'unpaidAmount'));
    }

	public function getCollectiveBill($billheads, $billsInfo){
		$sum = 0.0;
		foreach($billheads as $billhead){
            if($billhead->id ==   1){
                $sum = $sum + $billsInfo->col_1;
            }
            else if($billhead->id ==   2){
                $sum = $sum + $billsInfo->col_2;
            }
            else if($billhead->id ==   3){
                $sum = $sum + $billsInfo->col_3;
            }
            else if($billhead->id ==   4){
				$sum = $sum + $billsInfo->col_4;
            }
            else if($billhead->id ==   5){
                $sum = $sum + $billsInfo->col_5;
            }
            else if($billhead->id ==   6){
                $sum = $sum + $billsInfo->col_6;
            }
            else if($billhead->id ==   7){
                $sum = $sum + $billsInfo->col_7;
            }
            else if($billhead->id ==   8){
                $sum = $sum + $billsInfo->col_8;
            }
            else if($billhead->id ==   9){
				$sum = $sum + $billsInfo->col_9;
            }
            else if($billhead->id ==   10){
                $sum = $sum + $billsInfo->col_10;
            }
            else if($billhead->id ==   11){
                $sum = $sum + $billsInfo->col_11;
            }
            else if($billhead->id ==   12){
				$sum = $sum + $billsInfo->col_12;
            }
            else if($billhead->id ==   13){
				$sum = $sum + $billsInfo->col_13;
            }
            else if($billhead->id ==   14){
                $sum = $sum + $billsInfo->col_14;
            }
            else if($billhead->id ==   15){
                $sum = $sum + $billsInfo->col_15;
            }
            else if($billhead->id ==   16){
                $sum = $sum + $billsInfo->col_16;
            }
            else if($billhead->id ==   17){
                $sum = $sum + $billsInfo->col_17;
            }
            else if($billhead->id ==   18){
				$sum = $sum + $billsInfo->col_18;
            }
            else if($billhead->id ==   19){
                $sum = $sum + $billsInfo->col_19;
            }
            else if($billhead->id ==   20){
				$sum = $sum + $billsInfo->col_20;
            }
            else if($billhead->id ==   21){
				$sum = $sum + $billsInfo->col_21;
            }
            else if($billhead->id ==   22){
                $sum = $sum + $billsInfo->col_22;
            }
            else if($billhead->id ==   23){
                $sum = $sum + $billsInfo->col_23;
            }
            else if($billhead->id ==   24){
				$sum = $sum + $billsInfo->col_24;
            }
            else if($billhead->id ==   25){
                $sum = $sum + $billsInfo->col_25;
            }
            else if($billhead->id ==   26){
                $sum = $sum + $billsInfo->col_26;
            }
            else if($billhead->id ==   27){
				$sum = $sum + $billsInfo->col_27;
            }
            else if($billhead->id ==   28){
				$sum = $sum + $billsInfo->col_28;
            }
            else if($billhead->id ==   29){
				$sum = $sum + $billsInfo->col_29;
            }
		}
		return $sum;
	}
}
