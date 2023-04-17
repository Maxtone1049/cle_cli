@extends('front.layouts.master')
@section('content')
<div class="row justify-content-center mb-5">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <div class="signup-form text-center">
                    <h3>{{__('Sceurionpay Payment')}}</h3>
                    <form action="{{ route('sceurionpay.ipn')}}" method="post">
                        @csrf
						<div class="row mt-4">
                            <div class="col-lg-6">
                                <label class="float-left"><strong>{{__('Name on Card')}}</strong></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fa fa-credit-card"></i></span>
                                    </div>
                                    <input class="name form-control" id="the-card-name-id" name="card_name" placeholder="{{__('Enter the name on your card')}}"
									autocomplete="off" required>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <label class="float-left"><strong>{{__('Card Number')}}</strong></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fa fa-credit-card"></i></span>
                                    </div>
                                    <input class="card-number form-control" name="card_number" placeholder="{{__('Enter your card number')}}"
                            		autocomplete="off" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <label class="float-left"><strong>{{__('CVV')}}</strong></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fa fa-address-card"></i></span>
                                    </div>
                                    <input class="cvv form-control" autocomplete="off" class="card-cvc" placeholder="{{__('ex. 311')}}" type="text">
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <label class="float-left"><strong>{{__('Expiration Month')}}</strong></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                    </div>
                                    <input class="card-expiry-month form-control" name="expiry_month" placeholder='MM' type='text'>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <label class="float-left"><strong>{{__('Expiration Year')}}</strong></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                    </div>
                                    <input class="card-expiry-year form-control" name="expiry_year" placeholder="{{__('YYYY')}}" type="text">
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-12">
                            <div class="send-btn">
                                <button type="submit" class="btn btn-success btn-bg-2 btn-space btn-hover">{{__('Pay Now')}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection