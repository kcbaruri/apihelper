<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Traits\LocationTrait;
use App\Http\Controllers\Controller;


class LocationController extends Controller
{
  use LocationTrait;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
     public function getFlats(Request $request)
     {
         return json_encode($this->get_flat_dropdown($request->floor_id));
     }
     public function getThana(Request $request)
     {
         return json_encode($this->get_thana_dropdown($request->district_id));
     }
     public function getUnion(Request $request)
     {
         return json_encode($this->get_union_dropdown($request->thana_id));
     }
     public function getVillage(Request $request)
     {
         return json_encode($this->get_village_dropdown($request->union_id));
     }
     public function getPostOffice(Request $request)
     {
         return json_encode($this->get_post_office_dropdown($request->thana_id));
     }
}
