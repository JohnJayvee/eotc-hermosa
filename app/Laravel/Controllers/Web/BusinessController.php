<?php

namespace App\Laravel\Controllers\Web;

/*
 * Request Validator
 */
use App\Laravel\Requests\PageRequest;
use App\Laravel\Requests\Web\TransactionRequest;
use App\Laravel\Requests\Web\UploadRequest;
use App\Laravel\Requests\Web\BusinessRequest;
use App\Laravel\Requests\Web\UpdateBusinessRequest;
use App\Laravel\Requests\Web\BusinessPermitRequest;
use App\Laravel\Requests\Web\UpdateBusinessAddressRequest;
use App\Laravel\Models\Business;
use App\Laravel\Models\BusinessPermit;
use App\Laravel\Models\BusinessActivity;

/*
 * Models
 */


use Carbon,Auth,DB,Str,ImageUploader,Event,FileUploader,PDF,QrCode,Helper,Curl,Log;

class BusinessController extends Controller
{
     protected $data;
	protected $per_page;
	
	public function __construct(){
		parent::__construct();
		array_merge($this->data, parent::get_data());

		$this->data['business_scopes'] = ['national' => "National",'regional' => "Regional",'municipality' => "City/Municipality",'barangay' => "Barangay"];
		$this->data['business_types'] = ['sole_proprietorship' => "Sole Proprietorship",'cooperative' => "Cooperative",'corporation' => "Corporation",'partnership' => "Partnership"];
		$this->data['transaction_types'] = ['new' => "New Business",'renewal' => "Renewal"];
		$this->data['permit_types'] = ['business_permis' => "Business Permit"];
		$this->data['mode_of_payment'] = ['quarterly' => "Quarterly",'annually' => "Annually",'Semi-Annually' => "Semi-Annually"];
		$this->data['status'] = [ 'owned' => "Owned","leased" => "Leased"];
		if (Auth::guard('customer')->user()) {
			$this->data['auth'] = Auth::guard('customer')->user();
			$this->data['business_profiles'] = Business::where('customer_id',$this->data['auth']->id)->get();
		}
		$this->per_page = env("DEFAULT_PER_PAGE",10);
	}

		
	public function index(PageRequest $request){
		$this->data['page_title'] = "Business Profile";
		$this->data['auth'] = Auth::guard('customer')->user();
		return view('web.business.index',$this->data);
	}
	public function create(){
		$this->data['page_title'] = "Create Business CV";
		$this->data['auth'] = Auth::guard('customer')->user();

		return view('web.business.create',$this->data);

	}
	public function store(BusinessRequest $request){
		$auth = Auth::guard('customer')->user();
		
		DB::beginTransaction();
		try{
			$new_business = new Business;
			$new_business->customer_id = $auth->id;
			$new_business->business_scope = $request->get('business_scope');
			$new_business->business_type = $request->get('business_type');
			$new_business->dominant_name = $request->get('dominant_name');
			$new_business->business_name = $request->get('business_name');
			$new_business->business_line = $request->get('business_line');
			$new_business->capitalization = $request->get('capitalization');
			$new_business->region_name = $request->get('region_name');
			$new_business->town_name = $request->get('town_name');
			$new_business->region = $request->get('region');
			$new_business->town = $request->get('town');
			$new_business->brgy_name = $request->get('brgy_name');
			$new_business->brgy = $request->get('brgy');
			$new_business->zipcode = $request->get('zipcode');
			$new_business->unit_no = $request->get('unit_no');
			$new_business->street_address = $request->get('street_address');
			$new_business->email = $request->get('email');
			$new_business->mobile_no = $request->get('mobile_no');
			$new_business->telephone_no = $request->get('telephone_no');
			$new_business->tin_no = $request->get('tin_no');
			$new_business->sss_no = $request->get('sss_no');
			$new_business->philhealth_no = $request->get('philhealth_no');
			$new_business->pagibig_no = $request->get('pagibig_no');
			$new_business->save();
			DB::commit();
			session()->flash('notification-status', "success");
			session()->flash('notification-msg', "Business CV has been added.");
			return redirect()->route('web.business.index');
		}catch(\Exception $e){
			DB::rollback();
			session()->flash('notification-status', "failed");
			session()->flash('notification-msg', "Server Error: Code #{$e->getLine()}");
			return redirect()->back();
		}

	}
	public function business_profile(PageRequest $request , $id = NULL){

		$this->data['page_title'] = "Business Profile";

		$this->data['profile'] = Business::find($id);

		return view('web.business.profile',$this->data);
	}
	public function business_edit(PageRequest $request ,$id = NULL){
		$this->data['page_title'] = "Update Business CV";

		$this->data['auth'] = Auth::guard('customer')->user();

		$this->data['profile'] = Business::find($id);

		return view('web.business.edit-business',$this->data);
	}
	public function business_update(UpdateBusinessRequest $request , $id = NULL){
		$this->data['auth'] = Auth::guard('customer')->user();
		DB::beginTransaction();
		try{
			$update_business = Business::find($id);
			$update_business->business_scope = $request->get('business_scope');
			$update_business->business_type = $request->get('business_type');
			$update_business->dominant_name = $request->get('dominant_name');
			$update_business->business_name = $request->get('business_name');
			$update_business->business_line = $request->get('business_line');
			$update_business->capitalization = $request->get('capitalization');
			$update_business->email = $request->get('email');
			$update_business->mobile_no = $request->get('mobile_no');
			$update_business->telephone_no = $request->get('telephone_no');
			$update_business->save();
			DB::commit();
			session()->flash('notification-status', "success");
			session()->flash('notification-msg', "Business CV has been updated.");
			return redirect()->route('web.business.profile',[$id]);
		}catch(\Exception $e){
			DB::rollback();
			session()->flash('notification-status', "failed");
			session()->flash('notification-msg', "Server Error: Code #{$e->getLine()}");
			return redirect()->back();
		}
	}
	public function business_address_edit(PageRequest $request ,$id = NULL){
		$this->data['page_title'] = "Update Business Address";

		$this->data['auth'] = Auth::guard('customer')->user();

		$this->data['profile'] = Business::find($id);

		return view('web.business.edit-address',$this->data);
	}

	public function address_update(UpdateBusinessAddressRequest $request , $id = NULL){
		$this->data['auth'] = Auth::guard('customer')->user();
		DB::beginTransaction();
		try{
			$update_address = Business::find($id);
			$update_address->region_name = $request->get('region_name');
			$update_address->region = $request->get('region');
			$update_address->town_name = $request->get('town_name');
			$update_address->town = $request->get('town');
			$update_address->brgy_name = $request->get('brgy_name');
			$update_address->brgy = $request->get('brgy');
			$update_address->zipcode = $request->get('zipcode');
			$update_address->unit_no = $request->get('unit_no');
			$update_address->street_address = $request->get('street_address');
			$update_address->save();

			DB::commit();
			session()->flash('notification-status', "success");
			session()->flash('notification-msg', "Business Address has been updated.");
			return redirect()->route('web.business.profile',[$id]);
		}catch(\Exception $e){
			DB::rollback();
			session()->flash('notification-status', "failed");
			session()->flash('notification-msg', "Server Error: Code #{$e->getLine()}");
			return redirect()->back();
		}
	}
	public function other_info_edit(PageRequest $request ,$id = NULL){
		$this->data['page_title'] = "Update Business Address";

		$this->data['auth'] = Auth::guard('customer')->user();

		$this->data['profile'] = Business::find($id);

		return view('web.business.edit-others',$this->data);
	}
	public function other_info_update(PageRequest $request , $id = NULL){
		$this->data['auth'] = Auth::guard('customer')->user();
		DB::beginTransaction();
		try{
			$other_info = Business::find($id);
			$other_info->tin_no = $request->get('tin_no');
			$other_info->philhealth_no = $request->get('philhealth_no');
			$other_info->pagibig_no = $request->get('pagibig_no');
			$other_info->sss_no = $request->get('sss_no');
			$other_info->save();

			DB::commit();
			session()->flash('notification-status', "success");
			session()->flash('notification-msg', "Business Information has been updated.");
			return redirect()->route('web.business.profile',[$id]);
		}catch(\Exception $e){
			DB::rollback();
			session()->flash('notification-status', "failed");
			session()->flash('notification-msg', "Server Error: Code #{$e->getLine()}");
			return redirect()->back();
		}
	}

	public function permits(PageRequest $request , $id = NULL){
		$this->data['page_title'] = "Permits";
		$this->data['auth'] = Auth::guard('customer')->user();
		$this->data['id'] = $id;
		$this->data['profile'] = Business::find($id);
		$current_progress = $request->session()->get('current_progress');

		switch ($current_progress) {
			case '1':
				return view('web.business.permits',$this->data);
				break;
			case '2':
				return view('web.business.business_permit',$this->data);
				break;
			default:
				return view('web.business.permits',$this->data);
				break;
		}

		
	}

	public function permit_store(BusinessPermitRequest $request , $id = NULL){
		$this->data['auth'] = Auth::guard('customer')->user();
		$profile = Business::find($id);

		$current_progress = $request->session()->get('current_progress');

		switch ($current_progress) {
			case '1':
			    $request->session()->put('permit',$request->get('permit_type'));
				$request->session()->put('type',$request->get('transaction_type'));
				session()->put('current_progress',$current_progress + 1) ;
				break;
			case '2':
				DB::beginTransaction();
				try{
					dd(session()->get('type'));
					$new_business_permit = new BusinessPermit();
					$new_business_permit->owner_user_id = $profile->customer_id;
					$new_business_permit->business_id = $id;
					$new_business_permit->type = session()->get('type');
					$new_business_permit->owner_firstname = $profile->owner->fname;
					$new_business_permit->owner_middlename = $profile->owner->mname;
					$new_business_permit->owner_lastname = $profile->owner->lname;
					$new_business_permit->owner_suffix = $profile->owner->suffix;
					$new_business_permit->owner_tin = $profile->owner->tin_no;
					$new_business_permit->owner_mobile_no = $profile->owner->contact_number;
					$new_business_permit->owner_unit_no = $profile->owner->unit_number;
					$new_business_permit->owner_street_address = $profile->owner->street_name;
					$new_business_permit->owner_zipcode = $profile->owner->zipcode;
					$new_business_permit->owner_town = $profile->owner->town;
					$new_business_permit->owner_town_name = $profile->owner->town_name;
					$new_business_permit->owner_region = $profile->owner->region;
					$new_business_permit->owner_region_name = $profile->owner->region_name;
					$new_business_permit->owner_brgy = $profile->owner->barangay;
					$new_business_permit->owner_brgy_name  = $profile->owner->barangay_name;
					$new_business_permit->business_name  = $profile->business_name;
					$new_business_permit->business_dominant_name  = $profile->dominant_name;
					$new_business_permit->business_bn_number  = $profile->bn_number;
					$new_business_permit->business_scope  = $profile->business_scope;
					$new_business_permit->business_type  = $profile->business_type;
					$new_business_permit->business_mobile_no  = $profile->mobile_no;
					$new_business_permit->business_telephone_no  = $profile->telephone_no;
					$new_business_permit->business_email = $profile->email;
					$new_business_permit->business_unit_no  = $profile->unit_no;
					$new_business_permit->business_street_address  = $profile->street_address;
					$new_business_permit->business_brgy = $profile->brgy;
					$new_business_permit->business_brgy_name  = $profile->brgy_name;
					$new_business_permit->business_zipcode = $profile->zipcode;
					$new_business_permit->business_town = $profile->town;
					$new_business_permit->business_town_name = $profile->town_name;
					$new_business_permit->business_region = $profile->region;
					$new_business_permit->business_region_name = $profile->region_name;
					$new_business_permit->business_sss_no = $profile->sss_no;
					$new_business_permit->business_philhealth_no = $profile->philhealth_no;
					$new_business_permit->business_pagibig_no = $profile->pagibig_no;
					$new_business_permit->business_tin_no = $profile->tin_no;
					$new_business_permit->business_amendment  = $request->get('business_amendment');
					$new_business_permit->tax_entity  = $request->get('tax_entity');
					$new_business_permit->ctc_no  = $request->get('ctc_no');
					$new_business_permit->ctc_date_issue  = $request->get('ctc_date_issue');
					$new_business_permit->tax_incentive  = $request->get('tax_incentive');
					$new_business_permit->business_area  = $request->get('business_area');
					$new_business_permit->is_owned  = $request->get('business_status');
					$new_business_permit->lessor_fullname  = $request->get('lessor_fullname');
					$new_business_permit->lessor_full_address  = $request->get('lessor_address');
					$new_business_permit->lessor_phone_no  = $request->get('lessor_mobile_no');
					$new_business_permit->lessor_email  = $request->get('lessor_email');
					$new_business_permit->monthly_rental  = $request->get('monthly_rental');
					$new_business_permit->save();
					foreach ($request->get('business_line') as $key => $value) {
						$new_business_activity = new BusinessActivity();
						$new_business_activity->owner_user_id = $profile->customer_id;
						$new_business_activity->business_id = $id;
						$new_business_activity->business_line = $request->get('business_line')[$key];
						$new_business_activity->unit_no = $request->get('unit_no')[$key];
						$new_business_activity->capitalization = $request->get('capitalization')[$key];
						$new_business_activity->essentials = $request->get('essentials')[$key];
						$new_business_activity->non_essentials = $request->get('non_essentials')[$key];
						$new_business_activity->save();
					}
					DB::commit();
					session()->flash('notification-status', "success");
					session()->forget('current_progress');
					session()->forget('type');
					session()->flash('notification-msg', "Business Permit has been added.");
					return redirect()->route('web.business.profile',[$id]);
				}catch(\Exception $e){
					DB::rollback();
					session()->flash('notification-status', "failed");
					session()->flash('notification-msg', "Server Error: Code #{$e->getLine()}");
					return redirect()->back();
				}
			break;
			default:
				# code...
				break;
		}
		return redirect()->route('web.business.permit',$id);
	}
	public function revert (PageRequest $request , $id  = NULL){
		
		$current_progress = $request->session()->get('current_progress');
		if ($current_progress > 1) {
			session()->put('current_progress',$current_progress - 1);
			
		}else{
			session()->put('current_progress', 1);
		}

		return redirect()->route("web.business.permit",$id );
	}
	
}	

