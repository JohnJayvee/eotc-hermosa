<?php namespace App\Laravel\Requests\Web;

use Session,Auth;
use App\Laravel\Requests\RequestManager;

class BusinessPermitRequest extends RequestManager{

	public function rules(){

		$id = $this->route('id')?:0;
		$case = session()->get('current_progress');
		$type  = session()->get('type');
		switch ($case) {
			case '1':
				$rules = [
					'permit_type' => "required",
					'transaction_type' => "required",

				];
				break;
			case '2':
				$rules = [
					'registration_date' => "required",
					'registration_number' => "required",
					'business_amendment' => "required",
					'ctc_no' => "required",
					'ctc_date_issue' => "required",
					'tax_incentive' => "required",
					'business_status' => "required",
					'business_area' => "required",
				];

				if ($this->get('business_status') == "leased") {

					$rules['lessor_fullname'] = "required";
					$rules['lessor_address'] = "required";
					$rules['lessor_mobile_no'] = "required";
					$rules['lessor_email'] = "required";
					$rules['monthly_rental'] = "required";
				}
				if ($this->get('tax_incentive') == "yes") {
					$rules['tax_entity'] = "required";
				}
				foreach(range(1,count($this->get('business_line'))) as $index => $value){
					$rules["business_line.{$index}"] = "required";
					$rules["unit_no.{$index}"] = "required";
					if ($type == "new") {
						$rules["capitalization.{$index}"] = "required";
					}else{
						$rules["essentials.{$index}"] = "required";
						$rules["non_essentials.{$index}"] = "required";
					}

				}
				break;
			default:
				# code...
				break;
		}
		return $rules;
		
	}

	public function messages(){
		return [
			'required'	=> "Field is required.",

		];

	}
}