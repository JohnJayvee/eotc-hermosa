@extends('web._layouts.main')


@section('content')



<!--team section start-->
<section class="px-120 pt-110 pb-80 gray-light-bg">
    <div class="container">
        <div class="row">
            
            <div class="col-md-9">
                <form class="create-form" method="POST" enctype="multipart/form-data">
                    @include('system._components.notifications')
                    {!!csrf_field()!!}
                    <div class="card">
                        <div class="card-body">
                            <h5 class="text-title text-uppercase">Business Information</h5>
                            <div class="row">
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="text-form pb-2">Business Scope</label>
                                        {!!Form::select("business_scope", $business_scopes, old('business_scope',$profile->business_scope), ['id' => "input_business_scope", 'class' => "form-control form-control-sm classic ".($errors->first('business_scope') ? 'border-red' : NULL)])!!}
                                        @if($errors->first('business_scope'))
                                            <small class="form-text pl-1" style="color:red;">{{$errors->first('business_scope')}}</small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="text-form pb-2">Business Type</label>
                                        {!!Form::select("business_type", $business_types, old('business_type',$profile->business_type), ['id' => "input_business_type", 'class' => "form-control form-control-sm classic ".($errors->first('business_type') ? 'border-red' : NULL)])!!}
                                        @if($errors->first('business_type'))
                                            <small class="form-text pl-1" style="color:red;">{{$errors->first('business_type')}}</small>
                                        @endif
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="text-form pb-2">Dominant Name</label>
                                        <input type="text" class="form-control form-control-sm {{ $errors->first('dominant_name') ? 'is-invalid': NULL  }}"  name="dominant_name" value="{{old('dominant_name',$profile->dominant_name) }}">
                                        @if($errors->first('dominant_name'))
                                            <small class="form-text pl-1" style="color:red;">{{$errors->first('dominant_name')}}</small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="text-form pb-2">Business Name</label>
                                        <input type="text" class="form-control form-control-sm {{ $errors->first('dominant_name') ? 'is-invalid': NULL  }}"  name="business_name" value="{{old('business_name',$profile->business_name) }}">
                                        @if($errors->first('business_name'))
                                            <small class="form-text pl-1" style="color:red;">{{$errors->first('business_name')}}</small>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="text-form pb-2">Line of Business</label>
                                        <input type="text" class="form-control form-control-sm {{ $errors->first('business_line') ? 'is-invalid': NULL  }}"  name="business_line" value="{{old('business_line',$profile->business_line) }}">
                                        @if($errors->first('business_line'))
                                            <small class="form-text pl-1" style="color:red;">{{$errors->first('business_line')}}</small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="text-form pb-2">Capitalization</label>
                                        <input type="text" class="form-control form-control-sm {{ $errors->first('capitalization') ? 'is-invalid': NULL  }}"  name="capitalization" value="{{old('capitalization',$profile->capitalization) }}">
                                        @if($errors->first('capitalization'))
                                            <small class="form-text pl-1" style="color:red;">{{$errors->first('capitalization')}}</small>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="text-form pb-2">Email</label>
                                        <input type="text" class="form-control form-control-sm {{ $errors->first('email') ? 'is-invalid': NULL  }}"  name="email" value="{{old('email',$profile->email) }}">
                                        @if($errors->first('email'))
                                            <small class="form-text pl-1" style="color:red;">{{$errors->first('email')}}</small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="text-form pb-2">Mobile Number</label>
                                        <input type="text" class="form-control form-control-sm {{ $errors->first('mobile_no') ? 'is-invalid': NULL  }}"  name="mobile_no" value="{{old('mobile_no',$profile->mobile_no) }}">
                                        @if($errors->first('mobile_no'))
                                            <small class="form-text pl-1" style="color:red;">{{$errors->first('mobile_no')}}</small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="text-form pb-2">Telephone Number</label>
                                        <input type="text" class="form-control form-control-sm {{ $errors->first('telephone_no') ? 'is-invalid': NULL  }}"  name="telephone_no" value="{{old('telephone_no',$profile->telephone_no) }}">
                                        @if($errors->first('telephone_no'))
                                            <small class="form-text pl-1" style="color:red;">{{$errors->first('telephone_no')}}</small>
                                        @endif
                                    </div>
                                </div>
                            </div>
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


@endsection