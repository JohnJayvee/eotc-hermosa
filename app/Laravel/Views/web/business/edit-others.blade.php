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
                                        <label for="exampleInputEmail1" class="text-form pb-2">TIN No.</label>
                                        <input type="text" class="form-control form-control-sm {{ $errors->first('tin_no') ? 'is-invalid': NULL  }}"  name="tin_no" value="{{old('tin_no',$profile->tin_no) }}">
                                        @if($errors->first('tin_no'))
                                            <small class="form-text pl-1" style="color:red;">{{$errors->first('tin_no')}}</small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="text-form pb-2">SSS No.</label>
                                        <input type="text" class="form-control form-control-sm {{ $errors->first('sss_no') ? 'is-invalid': NULL  }}"  name="sss_no" value="{{old('sss_no',$profile->tin_no) }}">
                                        @if($errors->first('sss_no'))
                                            <small class="form-text pl-1" style="color:red;">{{$errors->first('sss_no')}}</small>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="text-form pb-2">Philhealth No.</label>
                                        <input type="text" class="form-control form-control-sm {{ $errors->first('philhealth_no') ? 'is-invalid': NULL  }}"  name="philhealth_no" value="{{old('philhealth_no',$profile->philhealth_no) }}">
                                        @if($errors->first('philhealth_no'))
                                            <small class="form-text pl-1" style="color:red;">{{$errors->first('philhealth_no')}}</small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="text-form pb-2">PAGIBIG No.</label>
                                        <input type="text" class="form-control form-control-sm {{ $errors->first('pagibig_no') ? 'is-invalid': NULL  }}"  name="pagibig_no" value="{{old('pagibig_no',$profile->pagibig_no) }}">
                                        @if($errors->first('pagibig_no'))
                                            <small class="form-text pl-1" style="color:red;">{{$errors->first('pagibig_no')}}</small>
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