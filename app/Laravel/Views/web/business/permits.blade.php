@extends('web._layouts.main')


@section('content')



<!--team section start-->
<section class="px-120 pt-110 pb-80 gray-light-bg">
    <div class="container">
        <div class="row">
            @include('web.business.business_sidebar')
            {{ Session::put('current_progress',1) }}
            <div class="col-md-9">
                <form class="create-form" method="POST" enctype="multipart/form-data">
                    @include('system._components.notifications')
                    {!!csrf_field()!!}
                    <div class="card">
                        <div class="card-body">
                            <h5 class="text-title text-uppercase">Business Transactions</h5>
                            <div class="row">
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="text-form pb-2">List of Permit</label>
                                        {!!Form::select("permit_type", $permit_types, old('permit_type'), ['id' => "input_permit_type", 'class' => "form-control form-control-sm classic ".($errors->first('permit_type') ? 'border-red' : NULL)])!!}
                                        @if($errors->first('permit_type'))
                                            <small class="form-text pl-1" style="color:red;">{{$errors->first('permit_type')}}</small>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="text-form pb-2"> Type</label>
                                        {!!Form::select("transaction_type", $transaction_types, old('transaction_type'), ['id' => "input_transaction_type", 'class' => "form-control form-control-sm classic ".($errors->first('transaction_type') ? 'border-red' : NULL)])!!}
                                        @if($errors->first('transaction_type'))
                                            <small class="form-text pl-1" style="color:red;">{{$errors->first('transaction_type')}}</small>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            
                            <button type="submit" class="btn badge-primary-2 text-white mr-2" style="float: right;">Proceed <i class="fa fa-arrow-right"></i></button>
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