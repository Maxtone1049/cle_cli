@extends('front.layouts.master')
@section('content')
<div class="row justify-content-center mb-5">
    <div class="col-lg-5">
        <div class="card">
            <div class="card-body">
                <div class="signup-form text-center">
                    <h3>{{__('Instamojo Payment')}}</h3>
                    <form id="payment-card-info" method="post" action="{{ route('instamojo.pay') }}">
                        @csrf
                        <div class="row mt-4">
                            <div class="col-lg-12">
                                <label class="float-left"><strong>{{__('Your Full Name')}}</strong></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fa fa-user"></i></span>
                                    </div>
                                    <input class="form-control" type="text" name="name" placeholder="{{__('Enter Name')}}" required>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <label class="float-left"><strong>{{__('Email Address')}}</strong></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                                    </div>
                                    <input type="text" class="form-control" name="email" placeholder="{{__('Enter Email')}}" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <label class="float-left"><strong>{{__('Phone Number')}}</strong></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                    </div>
                                    <input type="text" class="form-control" name="mobile_number" placeholder="{{__('Enter Mobile Number')}}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="send-btn">
                                <button type="submit" class="btn btn-success btn-bg-2 btn-space btn-hover">{{__('Submit')}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection