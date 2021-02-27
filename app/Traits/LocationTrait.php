<?php

namespace App\Traits;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use App\Models\Division;
use App\Models\District;
use App\Models\Thana;
use App\Models\Union;
use App\Models\Village;

trait LocationTrait
{
   public function get_division_dropdown(){
    $states = Division::orderBy('name')->pluck('name','id');
    return $states;
  }

  public function get_district_dropdown($division_id){
    $district = District::where('division_id',$division_id)->orderBy('name')->pluck('name','id');
    return $district;
  }

  public function get_thana_dropdown($district_id){
    $thana = Thana::where('district_id',$district_id)->orderBy('name','asc')->pluck('name','id');
    return $thana;
  }

  public function get_union_dropdown($thana_id){
    $union = Union::where('thana_id',$thana_id)->orderBy('name','asc')->pluck('name','id');
    return $union;
  }

  public function get_village_dropdown($union_id){
    $village = Village::where('union_id',$union_id)->orderBy('name','asc')->pluck('name','id');
    return $village;
  }

  /*  public function get_post_office_dropdown($thana_id){
    $thana = PostOffice::selectRaw("CONCAT(name,' (',zip_code,')') as name,zip_code")->where('thana_id',$thana_id)->orderBy('name','asc')->pluck('name','zip_code');
    return $thana;
  }*/

}
