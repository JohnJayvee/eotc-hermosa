
@extends('web._layouts.main')


@section('content')



<!--team section start-->
<section class="px-120 pt-110 pb-80 gray-light-bg">
    <div class="container">
        <div class="row">
            
            <div class="col-md-9">
                <form class="create-form" method="POST" enctype="multipart/form-data" id="myform">
                    @include('system._components.notifications')
                    {!!csrf_field()!!}
                    <div class="card">
                        <div class="card-body">
                            <h5 class="text-title text-uppercase">Business Information</h5>
                            <div class="row">
                                <div class="col-sm-12 col-md-6 col-lg-5">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="text-form pb-2">House/Bldg No.</label>
                                        <input type="text" class="form-control form-control-sm {{ $errors->first('unit_no') ? 'is-invalid': NULL  }}"  name="unit_no" value="{{old('unit_no',$profile->unit_no) }}">
                                        @if($errors->first('unit_no'))
                                            <small class="form-text pl-1" style="color:red;">{{$errors->first('unit_no')}}</small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-5">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="text-form pb-2">Street Address</label>
                                        <input type="text" class="form-control form-control-sm {{ $errors->first('street_address') ? 'is-invalid': NULL  }}"  name="street_address" value="{{old('street_address',$profile->street_address) }}">
                                        @if($errors->first('street_address'))
                                            <small class="form-text pl-1" style="color:red;">{{$errors->first('street_address')}}</small>
                                        @endif
                                    </div>
                                </div>
                                
                            </div>
                            <div class="row">
                            	<div class="col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                    <label for="exampleInputEmail1" class="text-form pb-2">Region</label>
                                       {!!Form::select('region',[],old('region',$profile->region),['id' => "input_region",'class' => "form-control form-control-sm classic ".($errors->first('region') ? 'border-red' : NULL)])!!}
                                        @if($errors->first('region'))
                                            <small class="form-text pl-1" style="color:red;">{{$errors->first('region')}}</small>
                                        @endif
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                            	<div class="col-sm-12 col-md-5 col-lg-5">
                                    <div class="form-group">
                                        <label class="text-form pb-2">City Municipality</label>
                                        {!!Form::select('town',[],old('town',$profile->town),['id' => "input_town",'class' => "form-control form-control-sm classic ".($errors->first('town') ? 'border-red' : NULL)])!!}
                                        @if($errors->first('town'))
                                            <small class="form-text pl-1" style="color:red;">{{$errors->first('town')}}</small>
                                        @endif
                                    </div>
                                </div>
                            	<div class="col-sm-12 col-md-5 col-lg-5">
                                    <div class="form-group">
                                        <label class="text-form pb-2">Barangay</label>
                                        {!!Form::select('brgy',[],old('brgy',$profile->brgy),['id' => "input_brgy",'class' => "form-control form-control-sm classic ".($errors->first('brgy') ? 'border-red' : NULL)])!!}
                                        @if($errors->first('brgy'))
                                            <small class="form-text pl-1" style="color:red;">{{$errors->first('brgy')}}</small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-2 col-lg-2">
                                    <div class="form-group">
                                        <label for="input_zipcode" class="text-form pb-2">Zipcode</label>
                                        <input type="text" id="input_zipcode" class="form-control form-control-sm  {{ $errors->first('zipcode') ? 'is-invalid': NULL  }}" name="zipcode" value="{{old('zipcode',$profile->zipcode)}}" readonly="readonly">
                                        @if($errors->first('zipcode'))
                                        <p class="help-block text-danger">{{$errors->first('zipcode')}}</p>
                                        @endif
                                    </div>
                           		</div>
                            </div>
                            <input type="hidden" name="region_name" value="" id="input_region_name" />
							<input type="hidden" name="town_name" value="" id="input_town_name" />
							<input type="hidden" name="brgy_name" value="" id="input_brgy_name" />
                            <a href="{{route('web.business.profile',[$profile->id])}}" class="btn btn-light" style="float: right;">Cancel</a>
                            <button type="submit" class="btn badge-primary-2 text-white mr-2" style="float: right;">Update Record</button>
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
    $.fn.get_region = function(input_region,input_province,input_city,input_brgy,selected){
    
      $(input_city).empty().prop('disabled',true)
      $(input_brgy).empty().prop('disabled',true)

      $(input_region).append($('<option>', {
                value: "",
                text: "Loading Content..."
            }));
      $.getJSON("{{env('PSGC_REGION_URL')}}", function( response ) {
          $(input_region).empty().prop('disabled',true)
          $.each(response.data,function(index,value){
            $(input_region).append($('<option>', {
                value: index,
                text: value
            }));
          })

          $(input_region).prop('disabled',false)
          $(input_region).prepend($('<option>',{value : "",text : "--Select Region--"}))
          if(selected.length > 0){
            $(input_region).val($(input_region+" option[value="+selected+"]").val());
          }else{
            $(input_region).val($(input_region+" option:first").val());
          }
      });
      // return result;
    };

    $.fn.get_city = function(reg_code,input_city,input_brgy,selected){
      $(input_brgy).empty().prop('disabled',true)
      $(input_city).append($('<option>', {
            value: "",
            text: "Loading Content..."
        }));
      $.getJSON("{{env('PSGC_CITY_URL')}}?region_code="+reg_code, function( data ) {
        console.log(data)
          $(input_city).empty().prop('disabled',true)
          $.each(data,function(index,value){
              $(input_city).append($('<option>', {
                  value: index,
                  text: value
              }));
          })

          $(input_city).prop('disabled',false)
          $(input_city).prepend($('<option>',{value : "",text : "--SELECT MUNICIPALITY/CITY, PROVINCE--"}))
          if(selected.length > 0){
            $(input_city).val($(input_city+" option[value="+selected+"]").val());
          }else{
            $(input_city).val($(input_city+" option:first").val());
          }
      });
      // return result;
    };

    $.fn.get_brgy = function(munc_code,input_brgy,selected){
      $(input_brgy).empty().prop('disabled',true);
      $(input_brgy).append($('<option>', {
                value: "",
                text: "Loading Content..."
            }));
      $.getJSON("{{env('PSGC_BRGY_URL')}}?city_code="+munc_code, function( data ) {
          $(input_brgy).empty().prop('disabled',true);

          $.each(data,function(index,value){
            $(input_brgy).append($('<option>', {
                value: index,
                text: value.desc,
                "data-zip_code" : (value.zip_code).trim()
            }));
          })
          $(input_brgy).prop('disabled',false)
          $(input_brgy).prepend($('<option>',{value : "",text : "--SELECT BARANGAY--"}))

          if(selected.length > 0){
            $(input_brgy).val($(input_brgy+" option[value="+selected+"]").val());

            if(typeof $(input_brgy+" option[value="+selected+"]").data('zip_code')  === undefined){
              $(input_brgy.replace("brgy","zipcode")).val("")
            }else{
              $(input_brgy.replace("brgy","zipcode")).val($(input_brgy+" option[value="+selected+"]").data('zip_code'))
            }

          }else{
            $(input_brgy).val($(input_brgy+" option:first").val());
          }
      });
    }
     $(function(){

       $(this).get_region("#input_region","#input_province","#input_town","#input_brgy","{{old('region', $profile->region)}}")

        $("#input_region").on("change",function(){
            var _val = $(this).val();
            var _text = $("#input_region option:selected").text();
            $(this).get_city($("#input_region").val(), "#input_town", "#input_brgy", "{{old('town')}}");
            $('#input_zipcode').val('');
            $('#input_region_name').val(_text);
        });

        $("#input_town").on("change",function(){
            var _val = $(this).val();
            var _text = $("#input_town option:selected").text();
            $(this).get_brgy(_val, "#input_brgy", "");
            $('#input_zipcode').val('');
            $('#input_town_name').val(_text);
        });

        @if(strlen(old('region')) > 0 || $profile->region)
	    	$(this).get_city("{{old('region', $profile->region)}}", "#input_town", "#input_brgy", "{{old('town', $profile->town)}}");
	    @endif

	    @if(strlen(old('town')) > 0 || $profile->town)
	    	$(this).get_brgy("{{old('town', $profile->town)}}", "#input_brgy", "{{old('brgy', $profile->brgy)}}");
	    @endif

	    $("#input_brgy").on("change",function(){
	     	$('#input_zipcode').val($(this).find(':selected').data('zip_code'))
	    });

        $("#input_brgy").on("change",function(){
            $('#input_zipcode').val($(this).find(':selected').data('zip_code'))
            var _text = $("#input_brgy option:selected").text();
            $('#input_brgy_name').val(_text);
        });
        $('#myform').submit(function() {
		    $('#input_region_name').val($("#input_region option:selected").text())
		    $('#input_province_name').val($("#input_province option:selected").text())
		    $('#input_town_name').val($("#input_town option:selected").text())
		    $('#input_brgy_name').val($("#input_brgy option:selected").text())
		    return true; // return false to cancel form action
		});
    })
</script>
@endsection