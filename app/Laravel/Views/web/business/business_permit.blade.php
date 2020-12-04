@extends('web._layouts.main')

@section('content')
<!--team section start-->
<section class="px-120 pt-110 pb-80 gray-light-bg">
    <div class="container">
        <div class="row">
            @include('web.business.business_sidebar')
            <div class="col-md-9">
                @include('web._components.notifications')
                <form class="create-form" method="POST" enctype="multipart/form-data">
                    @include('system._components.notifications')
                    {!!csrf_field()!!}

                    <div class="card">
                        <div class="card-body">
                            <h5 class="text-title text-uppercase">Business Permit Form</h5>
                           
                            <div class="row">
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="text-form pb-2"> Type</label>
                                        {!!Form::select("transaction_type", $transaction_types, old('transaction_type',Session::get('type')), ['disabled' => "disabled",'id' => "input_transaction_type", 'class' => "form-control form-control-sm classic ".($errors->first('transaction_type') ? 'border-red' : NULL)])!!}
                                        @if($errors->first('transaction_type'))
                                            <small class="form-text pl-1" style="color:red;">{{$errors->first('transaction_type')}}</small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="text-form pb-2">Date of Application</label>
                                        <input type="text" class="form-control form-control-sm {{ $errors->first('application_date') ? 'is-invalid': NULL  }}"  name="application_date" value="{{old('application_date',Carbon::now()->format('Y-m-d')) }}" readonly>
                                        @if($errors->first('application_date'))
                                            <small class="form-text pl-1" style="color:red;">{{$errors->first('application_date')}}</small>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                            	 <div class="col-sm-12 col-md-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="text-form pb-2">DTI/SEC/CDA Date of registration: </label>
                                        <input type="text" class="form-control form-control-sm {{ $errors->first('registration_date') ? 'is-invalid': NULL  }}"  name="registration_date" value="{{old('registration_date') }}">
                                        @if($errors->first('registration_date'))
                                            <small class="form-text pl-1" style="color:red;">{{$errors->first('registration_date')}}</small>
                                        @endif
                                    </div>
                                </div>
                            	
                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="text-form pb-2">DTI/SEC/CDA Registration No.: </label>
                                        <input type="text" class="form-control form-control-sm {{ $errors->first('registration_number') ? 'is-invalid': NULL  }}"  name="registration_number" value="{{old('registration_number') }}">
                                        @if($errors->first('registration_number'))
                                            <small class="form-text pl-1" style="color:red;">{{$errors->first('registration_number')}}</small>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                            	<div class="col-sm-12 col-md-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="text-form pb-2">Business Name </label>
                                        <p class="form-data text-success text-uppercase">{{$profile->business_name}}</p>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="text-form pb-2">Business Type</label>
                                        <p class="form-data text-success text-uppercase">{{$profile->business_type}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                            	<div class="col-sm-12 col-md-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="text-form pb-2">TIN : </label>
                                        <p class="form-data text-success">5464674686</p>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="text-form pb-2">Business Amendment</label>
                                        {!!Form::select("business_amendment", $business_types, old('business_amendment',$profile->business_type), ['id' => "input_business_amendment", 'class' => "form-control form-control-sm classic ".($errors->first('business_amendment') ? 'border-red' : NULL)])!!}
                                        @if($errors->first('business_amendment'))
                                            <small class="form-text pl-1" style="color:red;">{{$errors->first('business_amendment')}}</small>
                                        @endif
                                    </div>
                                </div>
                            </div>
                          
                            <div class="row">
                            	<div class="col-md-6">
                                    <div class="form-group">
                                        <label class="text-form">{{$profile->no_of_employee ?: "-" }}</label>
                                        <p>No. of Employee</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="text-form">50</label>
                                        <p>No. of Employee Residing within LGU</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                            	<div class="col-md-6">
                                    <div class="form-group">
                                        <label class="text-form">{{$profile->email ?: "-" }}</label>
                                        <p>Email</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="text-form">{{$profile->mobile_no ?: "-" }}</label>
                                        <p>Mobile Number</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                            	<div class="col-md-6">
                            		<div class="form-group">
                                        <label for="exampleInputEmail1" class="text-form pb-2">CTC Number </label>
                                        <input type="text" class="form-control form-control-sm {{ $errors->first('ctc_no') ? 'is-invalid': NULL  }}"  name="ctc_no" value="{{old('ctc_no') }}">
                                        @if($errors->first('ctc_no'))
                                            <small class="form-text pl-1" style="color:red;">{{$errors->first('ctc_no')}}</small>
                                        @endif
                                    </div>
                            	</div>
                            	<div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="text-form pb-2">CTC Date Issue </label>
                                        <input type="date" class="form-control form-control-sm {{ $errors->first('ctc_date_issue') ? 'is-invalid': NULL  }}"  name="ctc_date_issue" value="{{old('ctc_date_issue') }}" >
                                        @if($errors->first('ctc_date_issue'))
                                            <small class="form-text pl-1" style="color:red;">{{$errors->first('ctc_date_issue')}}</small>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                            	<div class="col-md-6">
                            		<label for="exampleInputEmail1" class="text-form pb-2">Are you enjoying tax incentive from any government Entity? </label>
                            		<div class="form-group">
                            			<div class="form-check form-check-inline">
										    <input class="form-check-input" type="radio" name="tax_incentive" value="yes" style="width: 30px; height: 30px;" {{ old('tax_incentive')=="yes" ? "checked" : "" }} >
											<label class="my-2 mx-1">Yes</label>
	                                    </div>

	                                    <div class="form-check form-check-inline">
										    <input class="form-check-input" type="radio" name="tax_incentive" value="no" style="width: 30px; height: 30px;"  {{ old('tax_incentive')=="no" ? "checked" : "" }}> 
											<label class="my-2 mx-1">NO</label>
	                                    </div>
                                        @if($errors->first('tax_incentive'))
                                            <small class="form-text pl-1" style="color:red;">{{$errors->first('tax_incentive')}}</small>
                                        @endif
										<input type="text" name="tax_entity" placeholder="Please Specify the entity" class="form-control form-control-sm" id="input_tax_entity">
                                        @if($errors->first('tax_entity'))
                                            <small class="form-text pl-1" style="color:red;">{{$errors->first('tax_entity')}}</small>
                                        @endif
                            		</div>
                            		
                            	</div>
                            	<div class="col-md-6">
                            		<div class="form-group">
                                        <label for="exampleInputEmail1" class="text-form pb-2">Business area in sqm </label>
                                        <input type="text" class="form-control form-control-sm {{ $errors->first('business_area') ? 'is-invalid': NULL  }}"  name="business_area" value="{{old('business_area') }}">
                                        @if($errors->first('business_area'))
                                            <small class="form-text pl-1" style="color:red;">{{$errors->first('business_area')}}</small>
                                        @endif
                                    </div>
                            	</div>
                            </div>
                            <div class="row">
                            	<div class="col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="text-form pb-2">Is the place of business owned or leased?</label>
                                        {!!Form::select("business_status", $status, old('business_status'), ['id' => "input_business_status", 'class' => "form-control form-control-sm classic ".($errors->first('business_status') ? 'border-red' : NULL)])!!}
                                        @if($errors->first('business_status'))
                                            <small class="form-text pl-1" style="color:red;">{{$errors->first('business_status')}}</small>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                            	<div class="col-md-6" id="lessor_fullname_container">
                            		<div class="form-group">
                                        <label for="exampleInputEmail1" class="text-form pb-2">Lessor's Fullname </label>
                                        <input type="text" class="form-control form-control-sm {{ $errors->first('lessor_fullname') ? 'is-invalid': NULL  }}"  name="lessor_fullname" value="{{old('lessor_fullname') }}" id="input_lessor_fullname">
                                        @if($errors->first('lessor_fullname'))
                                            <small class="form-text pl-1" style="color:red;">{{$errors->first('lessor_fullname')}}</small>
                                        @endif
                                    </div>
                            	</div>
                            	<div class="col-md-6" id="lessor_address_container">
                            		<div class="form-group">
                                        <label for="exampleInputEmail1" class="text-form pb-2">Lessor's Address </label>
                                        <input type="text" class="form-control form-control-sm {{ $errors->first('lessor_address') ? 'is-invalid': NULL  }}"  name="lessor_address" value="{{old('lessor_address') }}" id="input_lessor_address">
                                        @if($errors->first('lessor_address'))
                                            <small class="form-text pl-1" style="color:red;">{{$errors->first('lessor_address')}}</small>
                                        @endif
                                    </div>
                            	</div>
                            </div>
                            <div class="row">
                            	<div class="col-md-6" id="lessor_mobile_no_container">
                            		<div class="form-group">
                                        <label for="exampleInputEmail1" class="text-form pb-2">Lessor's Telephone/Mobile No. </label>
                                        <input type="text" class="form-control form-control-sm {{ $errors->first('lessor_mobile_no') ? 'is-invalid': NULL  }}"  name="lessor_mobile_no" value="{{old('lessor_mobile_no') }}" id="input_lessor_mobile_no">
                                        @if($errors->first('lessor_mobile_no'))
                                            <small class="form-text pl-1" style="color:red;">{{$errors->first('lessor_mobile_no')}}</small>
                                        @endif
                                    </div>
                            	</div>
                            	<div class="col-md-6" id="lessor_email_container">
                            		<div class="form-group">
                                        <label for="exampleInputEmail1" class="text-form pb-2">Lessor's Email Address </label>
                                        <input type="text" class="form-control form-control-sm {{ $errors->first('lessor_email') ? 'is-invalid': NULL  }}"  name="lessor_email" value="{{old('lessor_email') }}" id="input_lessor_email">
                                        @if($errors->first('lessor_email'))
                                            <small class="form-text pl-1" style="color:red;">{{$errors->first('lessor_email')}}</small>
                                        @endif
                                    </div>
                            	</div>
                            </div>
                            <div class="row">
                            	<div class="col-md-6" id="monthly_rental_container">
                            		<div class="form-group">
                                        <label for="exampleInputEmail1" class="text-form pb-2">Monthly Rental </label>
                                        <input type="text" class="form-control form-control-sm {{ $errors->first('monthly_rental') ? 'is-invalid': NULL  }}"  name="monthly_rental" value="{{old('monthly_rental') }}" id="input_monthly_rental">
                                        @if($errors->first('monthly_rental'))
                                            <small class="form-text pl-1" style="color:red;">{{$errors->first('monthly_rental')}}</small>
                                        @endif
                                    </div>
                            	</div>
                            </div>
                            <div class="row">
                            	<div class="col-md-6">
                            		<label class="text-form">Business Activity</label>
                            		<button class="btn btn-light btn-sm" id="repeater_add_activity" type="button"><i class="fa fa-plus"></i></button>

                            	</div>
                            	<div class="col-md-6">
                            	</div>
                            </div>
                            <div class="row">
                            	<div class="col-md-12" id="repeat_form">
                                    @foreach(range(1,count($errors->get('business_line.*')) ?: 1) as $index => $value)
                                		<div class="row activity">
                                			<div class="col-sm-{{Session::get('type') == "new" ? "4" :"3"}}">
    		                            		<div class="form-group">
    		                                        <label for="exampleInputEmail1" class="text-form pb-2">Line of Business </label>
    		                                        <input type="text" class="form-control form-control-sm {{ $errors->first("business_line.{$index}") ? 'is-invalid': NULL  }}"  name="business_line[]" value="{{old("business_line.{$index}") }}">
    		                                        @if($errors->first("business_line.{$index}"))
    		                                            <small class="form-text pl-1" style="color:red;">{{$errors->first("business_line.{$index}")}}</small>
    		                                        @endif
    		                                    </div>
                                			</div>
                                			<div class="col-sm-3">
    		                            		<div class="form-group">
    		                                        <label for="exampleInputEmail1" class="text-form pb-2">No of Units</label>
    		                                        <input type="text" class="form-control form-control-sm {{ $errors->first("unit_no.{$index}") ? 'is-invalid': NULL  }}"  name="unit_no[]" value="{{old("unit_no.{$index}") }}">
    		                                        @if($errors->first("unit_no.{$index}"))
    		                                            <small class="form-text pl-1" style="color:red;">{{$errors->first("unit_no.{$index}")}}</small>
    		                                        @endif
    		                                    </div>
                                			</div>
                                			@if(Session::get('type') == "new")
                                				<div class="col-sm-3">
    			                            		<div class="form-group">
    			                                        <label for="exampleInputEmail1" class="text-form pb-2">Capitalization</label>
    			                                        <input type="text" class="form-control form-control-sm {{ $errors->first("capitalization.{$index}") ? 'is-invalid': NULL  }}"  name="capitalization[]" value="{{old("capitalization.{$index}") }}">
    			                                        @if($errors->first("capitalization.{$index}"))
    			                                            <small class="form-text pl-1" style="color:red;">{{$errors->first("capitalization.{$index}")}}</small>
    			                                        @endif
    			                                    </div>
                                				</div>
                                			@endif
                                			@if(Session::get('type') == "renewal")
                                				<div class="col-sm-2">
    			                            		<div class="form-group">
    			                                        <label for="exampleInputEmail1" class="text-form pb-2">Essentials</label>
    			                                        <input type="text" class="form-control form-control-sm {{ $errors->first("essentials.{$index}") ? 'is-invalid': NULL  }}"  name="essentials[]" value="{{old("essentials.{$index}") }}">
    			                                        @if($errors->first("essentials.{$index}"))
    			                                            <small class="form-text pl-1" style="color:red;">{{$errors->first("essentials.{$index}")}}</small>
    			                                        @endif
    			                                    </div>
                                				</div>
                                				<div class="col-sm-2">
    			                            		<div class="form-group">
    			                                        <label for="exampleInputEmail1" class="text-form pb-2">Non-Essentials</label>
    			                                        <input type="text" class="form-control form-control-sm {{ $errors->first("non_essentials.{$index}") ? 'is-invalid': NULL  }}"  name="non_essentials[]" value="{{old("non_essentials.{$index}") }}">
    			                                        @if($errors->first("non_essentials.{$index}"))
    			                                            <small class="form-text pl-1" style="color:red;">{{$errors->first("non_essentials.{$index}")}}</small>
    			                                        @endif
    			                                    </div>
                                				</div>
                                			@endif
                                            @if($index > 0)
                                              <div class="col-md-2"><button type="button" style="margin-top: 28px;" class="btn btn-sm btn-danger btn-remove">Remove</button></div>
                                            @endif
                                		</div>
                                    @endforeach
                            	</div>
                            	
                            </div>

                            <button type="submit" class="btn badge-primary-2 text-white mr-2" style="float: right;">Proceed <i class="fa fa-arrow-right"></i></button>
                            <a href="{{route('web.business.revert',[$id])}}" class="btn btn-light mr-2" style="float: right;">Return</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
    </div>

</section>
<!--team section end-->


@stop

@section('page-scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<script type="text/javascript">
	 $("#repeat_form").delegate(".btn-remove","click",function(){
        var parent_div = $(this).parents(".activity");
        parent_div.fadeOut(500,function(){
          $(this).remove();
        })
    });

	$('#repeater_add_activity').on('click', function(){
        var repeat_item = $("#repeat_form .row").eq(0).prop('outerHTML');
        var main_holder = $(this).parents(".row").parent();

    $("#repeat_form").append(repeat_item).find("div[class^=col]:last").parent().append('<div class="col-md-2"><button type="button" style="margin-top: 28px;" class="btn bt-primary btn-sm btn-danger btn-remove">Remove</button></div>')
    });

    $('#input_business_status').on('change', function(){
    	var val = $(this).val();
    	if (val == 'leased') {

	    	$('#monthly_rental_container').show();
	        $('#lessor_email_container').show();
	        $('#lessor_address_container').show();
	        $('#lessor_fullname_container').show();
	        $('#lessor_mobile_no_container').show();
        
    	}else{
    		$('#monthly_rental_container').hide();
	        $('#lessor_email_container').hide();
	        $('#lessor_address_container').hide();
	        $('#lessor_fullname_container').hide();
	        $('#lessor_mobile_no_container').hide();
    	}
    }).change();
    $("input[type='radio']").on('change', function(){
        var radioValue = $("input[name='tax_incentive']:checked").val();
        if(radioValue == "yes"){
            $("#input_tax_entity").show();
        }else{
        	$("#input_tax_entity").hide();
        }
    }).change();
    
</script>
@endsection