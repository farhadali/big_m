<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistrantionFrom extends Model
{
    use HasFactory;

    protected $fillable=['name','email','division_id','district_id','upazila_id','address_details','language_proficiency','photo','cv_attachment','is_training','training_details'];

    public function division(){
    	return $this->hasOne(Division::class,'id','division_id')->select('id','name');
    }

    public function district(){
    	return $this->hasOne(District::class,'id','district_id')->select('id','name');
    }

    public function upazila(){
    	return $this->hasOne(Upazila::class,'id','upazila_id')->select('id','name');
    }
}



