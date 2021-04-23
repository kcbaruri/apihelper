<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use App\Models\BillHead;
use App\Models\FlatOwner;
use App\Models\Floor;
use App\Models\Tenant;
use App\Models\Bill;
use App\Models\Flat;

use PDF;
use DB;

class ReportController extends Controller
{
    public function getFlatOwnerReport(Request $request){
      
        $flatowners  = NULL;
        if($request->operation_type == "search" && $request->floor_id != 0){
            if($request->floor_id == 0 && $request->flat_id == 0){
                $flats = Flat::all();
            }
            else if($request->floor_id != 0 && $request->flat_id == 0){
                $flats = Flat::where('floor_id', '=', $request->floor_id)->get();
            }
            else{
                $flats = Flat::where('floor_id', '=', $request->floor_id)->where('id', '=', $request->flat_id)->get() ;
                             
            }

            $owner_id_array = array();
            foreach( $flats as $flat){
               array_push($owner_id_array, $flat->flat_owner_id);
            }
            
            $flatowners = DB::table('flat_owners')->whereIn('id', $owner_id_array)->get();
        }
        else if($request->operation_type == "download"){
            if($request->floor_id == 0 && $request->flat_id == 0){
                $flats = Flat::all();
            }
            else if($request->floor_id != 0 && $request->flat_id == 0){
                $flats = Flat::where('floor_id', '=', $request->floor_id)->get();
            }
            else{
                $flats = Flat::where('floor_id', '=', $request->floor_id)->where('id', '=', $request->flat_id)->get() ;
                             
            }

            $owner_id_array = array();
            foreach( $flats as $flat){
               array_push($owner_id_array, $flat->flat_owner_id);
            }
            
            $flatowners = DB::table('flat_owners')->whereIn('id', $owner_id_array)->get();

            $pdf = PDF::loadView('admin.reports.flatowners.flat_owner_info', compact('flatowners'));
            return $pdf->download('flat_owner_info.pdf')->header('Content-Type','application/pdf');

        }
        else{
            $flatowners = FlatOwner::all();
        }
       
       $floors = Floor::all();
       $flats = Flat::where('floor_id', '=', $floors[0]->id)->get();
      
       return view('admin.reports.flatowners.list', compact('flatowners', 'floors', 'flats'));
    }

    public function getIndividualOwnerReport($id){
        $flatowner = FlatOwner::find($id);

        $pdf = PDF::loadView('admin.reports.flatowners.rptflatowner_individual', compact('flatowner'));
        return $pdf->download('flat_owner_info.pdf')->header('Content-Type','application/pdf');
    }

    public function getFlatReport(Request $request){
        $flats = NULL;
        $floors = Floor::where('status','=', 1)->get();
        $query = DB::table('flats')
        ->leftJoin('floors', 'flats.floor_id', '=', 'floors.id')
        ->leftJoin('flat_owners', 'flats.flat_owner_id', '=', 'flat_owners.id')
        ->leftJoin('tenants', 'flats.id', '=', 'tenants.flat_id')
        ->select('flats.*','flat_owners.name as owner_name', 'floors.id as floor_id','floors.name as floor_name','tenants.id as tenant_id','tenants.name as tenant_name');
        
        if($request->floor_id != 0){
            $flats = $query->where('flats.floor_id', $request->floor_id)->orderBy('flats.id', 'ASC')->get();
        }
        else{
            $flats = $query->orderBy('flats.id', 'ASC')->get();
        }

        if($request->search == "download"){
          
            $pdf = PDF::loadView('admin.reports.flats.flat_report', compact('flats'));
            return $pdf->download('flat_report.pdf')->header('Content-Type','application/pdf');
        }
        else{
            return view('admin.reports.flats.list', compact('flats', 'floors'));
        }
     }


     public function getTenantInfo(Request $request){
       
        $tenants = NULL;

        $query = DB::table('tenants')
                ->select('tenants.*');
        $info = $query->where('tenants.is_master', 1)->orderBy('tenants.id', 'ASC')->orderBy('tenants.family_head_id', 'ASC')->get();
       
        if($request->floor_id == 0 && $request->flat_id == 0 && $request->is_head == 'on'){
            
            $tenants = Tenant::where('is_master', '=', 1)->orderBy('id', 'ASC')->orderBy('family_head_id', 'ASC')->get();
        }
        else if($request->floor_id == 0 && $request->flat_id == 0 && $request->is_head == NULL){
           
            $tenants = Tenant::all();
        }
        else if($request->floor_id != 0 && $request->flat_id == 0 && $request->is_head == 'on'){
           
            $tenants = Tenant::where('floor_id', '=', $request->floor_id)->where('is_master', '=', 1)->get();
        }
        else if($request->floor_id != 0 && $request->flat_id == 0 && $request->is_head == NULL){
           
            $tenants = Tenant::where('floor_id', '=', $request->floor_id)->get();
        }

        else if($request->floor_id != 0 && $request->flat_id != 0 && $request->is_head == 'on'){
           
            $tenants = Tenant::where('floor_id', '=', $request->floor_id)->where('flat_id', '=', $request->flat_id)->where('is_master', '=', 1)->get();
        }
        else if($request->floor_id != 0 && $request->flat_id != 0 && $request->is_head == NULL){
            $tenants = Tenant::where('floor_id', '=', $request->floor_id)->where('flat_id', '=', $request->flat_id)->get();
        }
        
        return $tenants;
     }

     public function getTenantReport(Request $request){
       
        $tenants  = NULL;
        if($request->operation_type == "search"){
           $tenants = self:: getTenantInfo($request);
        }
        else if($request->operation_type == "download"){
            
            $tenants = self:: getTenantInfo($request);

            $pdf = PDF::loadView('admin.reports.tenants.tenant_report', compact('tenants'));
            return $pdf->download('tenant_report.pdf')->header('Content-Type','application/pdf');

        }
        else{
            $tenants = Tenant::all();
        }
       
       $floors = Floor::all();
       $flats = Flat::where('floor_id', '=', $floors[0]->id)->get();
      
       return view('admin.reports.tenants.list', compact('tenants', 'floors', 'flats'));
     }

     public function getBillReport(Request $request){
        $floors = Floor::all();
        $flats = Flat::where('floor_id', '=', $floors[0]->id)->get();
        $generatedbill = Bill::all();
        return view('admin.reports.bills.list', compact('floors', 'flats', 'generatedbill'));
     }

     
     public function getInOutReport(Request $request){
        return view('admin.reports.inouts.list');
     }


    public function getCitizenReport(Request $request)
    {
        $query = Citizen::with('vatatype','division','district','thana','union','village')->where('status','!=','-1');

        if($request->nid != null){             
            $query->where('nid', 'like', '%'.$request->nid.'%');
        }

        if($request->division_id > 0){
            $query->where('division_id', '=', $request->division_id);
        }

        if($request->district_id > 0){
            $query->where('district_id', '=', $request->district_id);
        }

        if($request->thana_id > 0){
            $query->where('thana_id', '=', $request->thana_id);
        }

        if($request->union_id > 0){
            $query->where('union_id', '=', $request->union_id);
        }

        $citizens = $query->orderBy('name', 'ASC')->get();
        $divisions = Division::where('status','=', 1)->get();
        $districts = District::where('status','=', 1)->get();
        $thanas = Thana::where('status','=', 1)->get();
        $unions = Union::where('status','=', 1)->get();
        $villages = Village::where('status','=', 1)->get();

        if($request->search == "download") {

            //$pdf = PDF::setOptions(['dpi' => 150, 'defaultFont' => 'SolaimanLipi', 'defaultPaperSize' => 'a4'])->loadView('admin.citizen_reports.citizen_report', compact('citizens'));
            $pdf = PDF::loadView('admin.citizen_reports.citizen_report', compact('citizens'));
            return $pdf->download('citizens.pdf')->header('Content-Type','application/pdf');
            //return $pdf->stream('document.pdf');
            } else {
    
            return view('admin.citizen_reports.index', compact('citizens','divisions','districts','thanas','unions'));
            }
    }

    public function getVataHandoverReport(Request $request)
    {

        $query = DB::table('vata_handovers')
        ->leftJoin('citizens', 'vata_handovers.citizen_id', '=', 'citizens.id')
        ->leftJoin('divisions', 'divisions.id', '=', 'citizens.division_id')
        ->leftJoin('districts', 'districts.id', '=', 'citizens.district_id')
        ->leftJoin('thanas', 'thanas.id', '=', 'citizens.thana_id')
        ->leftJoin('unions', 'unions.id', '=', 'citizens.union_id')
        ->select('vata_handovers.*','citizens.id','citizens.name','citizens.division_id','citizens.district_id','citizens.thana_id','citizens.union_id','divisions.id','divisions.name as division_name','districts.id','districts.name as district_name','thanas.id','thanas.name as thana_name','unions.id','unions.name as union_name');

        if($request->name != null){             
            $query->where('citizens.name', 'like', '%'.$request->name);
        }

        if($request->year > 0){
            $query->where('vata_handovers.year', '=', $request->year);
        }

        if($request->month != null){
            $query->where('vata_handovers.month', '=', $request->month);
        }

        if($request->division_id > 0){
            $query->where('citizens.division_id', '=', $request->division_id);
        }

        if($request->district_id > 0){
            $query->where('citizens.district_id', '=', $request->district_id);
        }

        if($request->thana_id > 0){
            $query->where('citizens.thana_id', '=', $request->thana_id);
        }

        if($request->union_id > 0){
            $query->where('citizens.union_id', '=', $request->union_id);
        }

        if($request->from_date != null){  
            $from_date = $request->from_date." 00:00:00";           
            $query->where('vata_handovers.created_at', '>',$from_date);
        }

        if($request->to_date != null){  
            $to_date = $request->to_date." 00:00:00";           
            $query->where('vata_handovers.created_at', '<',$to_date);
        }

        $handovers = $query->orderBy('vata_handovers.id', 'ASC')->get();


        if($request->search == "download") {

            $pdf = PDF::loadView('admin.citizen_reports.handover_report', compact('handovers'));
            return $pdf->download('vata_handovers.pdf')->header('Content-Type','application/pdf');
            } else {
                $divisions = Division::where('status','=', 1)->get();
                $districts = District::where('status','=', 1)->get();
                $thanas = Thana::where('status','=', 1)->get();
                $unions = Union::where('status','=', 1)->get();
            return view('admin.citizen_reports.handover', compact('handovers','divisions','districts','thanas','unions'));
        }
    }
   
}
