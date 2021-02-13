<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RegistrantionFrom;
use App\Models\Division;
use App\Models\District;
use App\Models\Upazila;

class AdminController extends Controller
{
    //=========================
    //  Display registratin list
    //==========================

    public function index(Request $request){
    	$divisions = Division::orderBy('name','asc')->get();
    	$info = RegistrantionFrom::with(['division','district','upazila']);
    	$districts = [];
    	$upazilas = [];
    	if($request->has('name')){
    		$info= $info->where('name','like','%'.$request->name.'%');
    	}
    	if($request->has('email')){
    		$info= $info->where('email','like','%'.$request->email.'%');
    	}
    	if($request->has('division_id')){
    		$districts = District::where('division_id',$request->division_id)->get();
    		$info= $info->where('division_id','like','%'.$request->division_id.'%');
    	}
    	if($request->has('district_id')){
    		$upazilas = Upazila::where('district_id',$request->district_id)->get();
    		$info= $info->where('district_id','like','%'.$request->district_id.'%');
    	}
    	if($request->has('upazila_id')){
    		$info= $info->where('upazila_id','like','%'.$request->upazila_id.'%');
    	}
    	$info= $info->paginate(10);
    	


    	return view('dashboard',compact('info','divisions','request','districts','upazilas'));
    	

    }
}
