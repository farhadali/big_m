<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Language;
use App\Models\ExamName;
use App\Models\BoardName;
use App\Models\University;
use App\Models\Division;
use App\Models\District;
use App\Models\Upazila;
use App\Models\RegistrantionFrom;
use App\Models\EducationInfo;
use App\Models\TrainingDetail;
use DB;

class RegistrantionFromController extends Controller
{
   //===================================
   //Registration form show
   //
   //====================================
	public function index(){
		$languages = Language::get();
		$divisions = Division::orderBy('name','asc')->get();
		$exams = ExamName::orderBy('serial','asc')->get();
		$boards = BoardName::orderBy('name','asc')->get();
		$universites = University::orderBy('serial','asc')->get();


		return view('welcome',compact('divisions','languages','exams','boards','universites'));
	}

	//========================================
	// Registration form data store by ajax 
	//
	//====================================

   public function store(Request $request){
   		$request->validate([
        'name'=> 'required|max:255',
        'email' => 'required',
        'division_id' => 'required',
        'district_id' => 'required',
        'upazila_id' => 'required',
        'is_training' => 'required',
        'address_details' => 'required',
        'photo' => 'required|image|mimes:jpeg,png,jpg',
        'cv_attachment' => 'required|file|mimes:pdf,docx,doc',
      ]);

		DB::beginTransaction();

		try {
		    if($request->hasFile('photo')){
		           $file = $request->file('photo');
		           $photo =  date('mdYHis') . uniqid().".". $file->getClientOriginalExtension();
		           $nameWithBasePath = $photo;
		           $file->move('images/', $photo);
		           
		       }

		   	 if($request->hasFile('cv_attachment')){
		           $file = $request->file('cv_attachment');
		           $cv_attachment =  date('mdYHis') . uniqid().".". $file->getClientOriginalExtension();
		           $nameWithBasePath = $cv_attachment;
		           $file->move('images/', $cv_attachment);
		           
		      }

		      $information = new RegistrantionFrom();
		      $information->name = $request->name;
		      $information->email = $request->email;
		      $information->division_id = $request->division_id;
		      $information->district_id = $request->district_id;
		      $information->upazila_id = $request->upazila_id;
		      $information->is_training = $request->is_training;
		      $information->address_details = $request->address_details;
		      $information->photo = $photo;
		      $information->cv_attachment = $cv_attachment;
		      $information->language_proficiency = json_encode($request->language_proficiency);
		      $information->save();
		      $register_id = $information->id;

		      if(sizeof($request->exam_id) > 0){
		      	for ($i=0; $i <sizeof($request->exam_id) ; $i++) { 
		      		$EducationInfo = new EducationInfo();
		      		$EducationInfo->registration_id = $register_id;
		      		$EducationInfo->exam_id = $request->exam_id[$i] ?? null;
		      		$EducationInfo->university_id = $request->university_id[$i] ?? null;
		      		$EducationInfo->board_id = $request->board_id[$i] ?? null;
		      		$EducationInfo->save();
			    }
		      }

		      if(sizeof($request->traing_name) > 0){
		      	for ($i=0; $i <sizeof($request->traing_name) ; $i++) { 
		      		$TrainingDetail = new TrainingDetail();
		      		$TrainingDetail->register_id = $register_id;
		      		$TrainingDetail->name = $request->traing_name[$i] ?? null;
		      		$TrainingDetail->detail = $request->traing_details[$i] ?? null;
		      		$TrainingDetail->save();
			    }
		      }
		      
		      
		    DB::commit();
		    $msg = "information Save Successfully";
		   	return $msg; 


		} catch (\Exception $e) {
		    DB::rollback();
		    throw $e;
		} catch (\Throwable $e) {
		    DB::rollback();
		    throw $e;
		}

   	 
   }

	//====================
   // Division and district wise information fetch
   //=====================
   public function comboInfo(Request $request){
   	if($request->type =='division'){
   		$districts = District::where('division_id',$request->id)->get();
   		$dis =  view('district',compact('districts'));
   		return $dis;
   	}

   	if($request->type =='district'){
   		$upazilas = Upazila::where('district_id',$request->id)->get();
   		$dis =  view('upazila',compact('upazilas'));
   		return $dis;
   	}

   }




}
