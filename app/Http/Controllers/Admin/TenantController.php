<?php

namespace App\Http\Controllers\Admin;

use App\Models\Division;
use App\Models\District;
use App\Models\Thana;
use App\Models\Union;
use App\Models\Village;
use App\Models\Vatatype;
use App\Models\Vatahandover;
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
        $divisions = Division::where('status','=', 1)->get();
        $districts = District::where('status','=', 1)->get();
        $thanas = Thana::where('status','=', 1)->get();
        $unions = Union::where('status','=', 1)->get();
        $villages = Village::where('status','=', 1)->get();
        $vata_types = Vatatype::where('status','=', 1)->get();
        return view('admin.citizens.create', compact('divisions','districts','thanas','unions','villages','vata_types'));
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
            'father_name' => ['required','string'],
            'mother_name' => ['required','string'],
            'dob' => ['required'],
            'profession_id' => 'required|numeric|gt:0',
            'monthly_income' => 'required|numeric|gt:0',
            'annual_income' => 'required|numeric|gt:0',
            'vata_book_number' => ['required'],
            'bank' => ['required'],
            'bank_branch' => ['required'],
            'bank_account_number' => ['required'],
            'nid' => ['required','numeric','unique:citizens'],
        ])->validate();
        
        try {
            $citizen = Citizen::create([
                'vata_type_id' => $request->input('vata_type_id'),
                'name' => $request->input('name'),
                'image' => '',
                'spouse_name' => $request->input('spouse_name'),
                'is_spouse_alive' => $request->input('is_spouse_alive'),
                'father_name' => $request->input('father_name'),
                'mother_name' => $request->input('mother_name'),
                'dob' => date('Y-m-d',strtotime($request->input('dob'))),
                'sex' => $request->input('sex'),
                'vata_book_number' => $request->input('vata_book_number'),
                'bank' => $request->input('bank'),
                'bank_branch' => $request->input('bank_branch'),
                'bank_account_number' => $request->input('bank_account_number'),
                'division_id' => $request->input('division_id'),
                'district_id' => $request->input('district_id'),
                'profession_id' => $request->input('profession_id'),
                'monthly_income' => $request->input('monthly_income'),
                'annual_income' => $request->input('annual_income'),
                'thana_id' => $request->input('thana_id'),
                'union_id' => $request->input('union_id'),
                'village_id' => $request->input('village_id'),
                'ward' => $request->input('ward'),
                'nid' => $request->input('nid'),
                'blood_group' => $request->input('blood_group'),
                'last_vata_receive_date' => $request->input('last_vata_receive_date'),
                'receive_amount' => $request->input('receive_amount'),
                'religion' => $request->input('religion')
            ]);

            $citizen->image = $this->uploadFiles($request,'images/',$citizen->id);
            $citizen->save();
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->withErrors("Something went wrong");
        }

        return redirect()->route('admin.citizens', ['citizen'=>$citizen])->with('success', "Successfully created Citizen");
    }

    /**


     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $professionArray = array(
            "1" => "Chiropractor",
            "2"  => "Dentist",
            "3" => "Dietitian or Nutritionist",
            "4" => "Optometrist",
            "5" => "Pharmacist",
            "6" => "Physician",
            "7" => "Physician Assistant",
            "8" => "Podiatrist",
            "9" => "Registered Nurse",
            "10" => "Therapist",
            "11" => "Veterinarian",
            "12" =>  "Health Technologist or Technician",
            "13" => "Other Healthcare Practitioners and Technical Occupation",
            "14" => "Nursing, Psychiatric, or Home Health Aide",
            "15" => "Occupational and Physical Therapist Assistant or Aide",
            "16" =>  "Other Healthcare Support Occupation",
            "17" =>  "Chief Executive",
            "18" =>  "General and Operations Manager",
            "19" =>  "Advertising, Marketing, Promotions, Public Relations, and Sales Manager",
            "20" => "Operations Specialties Manager (e.g., IT or HR Manager)",
            "21" =>  "Construction Manager",
            "22" =>  "Engineering Manager",
            "23" =>  "Accountant, Auditor",
            "24" => "Business Operations or Financial Specialist",
            "25" => "Business Owner",
            "26" => "Other Business, Executive, Management, Financial Occupation",
            "27" =>  "Architect, Surveyor, or Cartographer",
            "28" =>  "Engineer",
            "29" =>  "Other Architecture and Engineering Occupation",
            "30" => "Postsecondary Teacher (e.g., College Professor)",
            "31" =>  "Primary, Secondary, or Special Education School Teacher",
            "32" =>  "Other Teacher or Instructor",
            "33" => "Other Education, Training, and Library Occupation",
            "34" =>  "Arts, Design, Entertainment, Sports, and Media Occupations",
            "35" =>  "Computer Specialist, Mathematical Science",
            "36" => "Counselor, Social Worker, or Other Community and Social Service Specialist",
            "37" => "Lawyer, Judge",
            "38" => "Life Scientist (e.g., Animal, Food, Soil, or Biological Scientist, Zoologist)",
            "39" => "Physical Scientist (e.g., Astronomer, Physicist, Chemist, Hydrologist)",
            "40" =>  "Religious Worker (e.g., Clergy, Director of Religious Activities or Education)",
            "41" =>  "Social Scientist and Related Worker",
            "42" => "Other Professional Occupation",
            "43" => "Supervisor of Administrative Support Workers",
            "44" =>  "Financial Clerk",
            "45" => "Secretary or Administrative Assistant",
            "46" => "Material Recording, Scheduling, and Dispatching Worker",
            "47" =>  "Other Office and Administrative Support Occupation",
            "48" => "Protective Service (e.g., Fire Fighting, Police Officer, Correctional Officer)",
            "49" =>  "Chef or Head Cook",
            "50" => "Cook or Food Preparation Worker",
            "51" => "Food and Beverage Serving Worker (e.g., Bartender, Waiter, Waitress)",
            "52" => "Building and Grounds Cleaning and Maintenance",
            "53" => "Personal Care and Service (e.g., Hairdresser, Flight Attendant, Concierge)",
            "54" => "Sales Supervisor, Retail Sales",
            "55" => "Retail Sales Worker",
            "56" => "Insurance Sales Agent",
            "57" => "Sales Representative",
            "58" => "Real Estate Sales Agent",
            "59" => "Other Services Occupation",
            "60" => "Construction and Extraction (e.g., Construction Laborer, Electrician)",
            "61" => "Farming, Fishing, and Forestry",
            "62" => "Installation, Maintenance, and Repair",
            "63" =>  "Production Occupations",
            "64" =>  "Other Agriculture, Maintenance, Repair, and Skilled Crafts Occupation",
            "65" =>  "Aircraft Pilot or Flight Engineer",
            "66" =>  "Motor Vehicle Operator (e.g., Ambulance, Bus, Taxi, or Truck Driver)",
            "67" =>  "Other Transportation Occupation",
            "68" =>  "Military",
            "69" =>  "Homemaker",
            "70" =>  "Other Occupation",
            "71" =>  "Don't Know",
            "72" => "Not Applicable");

        $citizen = Citizen::with('division','district','thana','union','village')->find($id);
        return view('admin.citizens.view')->with(compact( 'citizen', 'professionArray'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $citizen = Citizen::find($id);
        $divisions = Division::where('status','=', 1)->get();
        $districts = District::where('status','=', 1)->get();
        $thanas = Thana::where('status','=', 1)->get();
        $unions = Union::where('status','=', 1)->get();
        $villages = Village::where('status','=', 1)->get();
        $vata_types = Vatatype::where('status','=', 1)->get();
        return view('admin.citizens.edit')->with(compact( 'citizen','divisions','districts','thanas','unions','villages','vata_types'));
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
            'father_name' => ['required','string'],
            'mother_name' => ['required','string'],
            'dob' => ['required'],
            'profession_id' => 'required|numeric|gt:0',
            'monthly_income' => 'required|numeric|gt:0',
            'annual_income' => 'required|numeric|gt:0',
            'vata_book_number' => ['required'],
            'bank' => ['required'],
            'bank_branch' => ['required'],
            'bank_account_number' => ['required'],
            'nid' => ['required','numeric', 'unique:citizens,nid,'. $id],
        ])->validate();

        try {
            $citizen = Citizen::find($id);

            if($citizen == null)
                return redirect()->back()->withErrors("citizen Not Found");

            $citizen->vata_type_id = $request->input('vata_type_id');
            $citizen->name = $request->input('name');
            if ($request->hasFile('image')) {
            $citizen->image = $this->uploadFiles($request,'images/',$id);
            }
            $citizen->spouse_name = $request->input('spouse_name');
            $citizen->profession_id = $request->input('profession_id');
            $citizen->monthly_income = $request->input('monthly_income');
            $citizen->annual_income = $request->input('annual_income');

            $citizen->is_spouse_alive = $request->input('is_spouse_alive');
            $citizen->father_name = $request->input('father_name');
            $citizen->mother_name = $request->input('mother_name');
            $citizen->dob = date('Y-m-d',strtotime($request->input('dob')));
            $citizen->sex = $request->input('sex');
            $citizen->vata_book_number = $request->input('vata_book_number');
            $citizen->bank = $request->input('bank');
            $citizen->bank_branch = $request->input('bank_branch');
            $citizen->bank_account_number = $request->input('bank_account_number');
            $citizen->division_id = $request->input('division_id');
            $citizen->district_id = $request->input('district_id');
            $citizen->thana_id = $request->input('thana_id');
            $citizen->union_id = $request->input('union_id');
            $citizen->village_id = $request->input('village_id');
            $citizen->ward = $request->input('ward');
            $citizen->nid = $request->input('nid');
            $citizen->blood_group = $request->input('blood_group');
            $citizen->last_vata_receive_date = $request->input('last_vata_receive_date');
            $citizen->receive_amount = $request->input('receive_amount');
            $citizen->religion = $request->input('religion');
            $citizen->status = $request->input('status');

            $citizen->save();

     
        } catch (\Exception $e) {
            return redirect()->back()->withErrors("Something went wrong");
        }

        return redirect()->route('admin.citizens')
                         ->with('success', "Successfully updated citizen");
    }

    public function delete($id)
    {
        try {
            
            $citizen = Citizen::find($id);
            $citizen->delete();
            return redirect()->back()->with('success', 'Successfully deleted citizen.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Something went wrong!');
        }
    }

    public function vataHandover($id){
        $citizen = Citizen::with('vatatype')->find($id);
        return view('admin.citizens.vata_handover')->with(compact( 'citizen'));
    }

    public function storeHandover(Request $request){
        $validator = Validator::make($request->all(), [
            'year' => ['required', 'integer'],
            'month' => ['required', 'string', 'max:255'],
            'amount' => ['required']
        ])->validate();
        
        try {
            $handover = Vatahandover::create([
                'citizen_id' => $request->input('citizen_id'),
                'year' => $request->input('year'),
                'month' => $request->input('month'),
                'amount' => $request->input('amount')
            ]);

        } catch (\Exception $e) {
            //dd($e);
            return redirect()->back()->withErrors("Something went wrong");
        }

        return redirect()->route('admin.citizens')->with('success', "Successfully created Citizen");
    }
}
