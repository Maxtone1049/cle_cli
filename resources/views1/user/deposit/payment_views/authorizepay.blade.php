@extends('front.layouts.master')
@section('content')

@php
    $months = array(1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'May', 6 => 'Jun', 7 => 'Jul', 8 => 'Aug', 9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Dec');
@endphp

<div class="row justify-content-center mb-5">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <div class="signup-form text-center">
                    <h3>{{__('Authorize.Net Payment')}}</h3>
                    <form id="payment-card-info" method="post" action="{{ route('authorize.dopay.online') }}">
                        @csrf
                        <div class="row mt-4">
                            <div class="col-lg-6">
                                <label class="float-left"><strong>{{__('Name on Card')}}</strong></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fa fa-credit-card"></i></span>
                                    </div>
                                    <input class="form-control" type="text" id="owner" name="owner" value="{{'Simon'}}" required>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <label class="float-left"><strong>{{__('Card Number')}}</strong></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fa fa-credit-card"></i></span>
                                    </div>
                                    <input type="text" class="form-control" id="cardNumber" name="cardNumber" value="{{'4111 1111 1111 1111'}}" required>
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
                                    <input class="form-control" type="text" id="cvv" name="cvv" value="{{'123'}}" required>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <label class="float-left"><strong>{{__('Amount')}}</strong></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fa fa-dollar-sign"></i></span>
                                    </div>
                                    <input class="form-control" type="number" id="amount" readonly name="amount" min="1" value="{{ $usd }}" required>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="row">
                                    <div class="col-md-7">
                                        <label class="float-left"><strong>{{__('Expiration Month')}}</strong></label>
                                        <div class="form-group">
                                            <select class="form-control author_month" id="expiration-month" name="expiration-month">
                                                @foreach($months as $k=>$v)
                                                    <option value="{{ $k }}" {{ old('expiration-month') == $k ? 'selected' : '' }}>{{ $v }}</option>                                                        
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <label class="float-left"><strong>{{__('/ Years')}}</strong></label>
                                        <div class="form-group">
                                            <select class="form-control author_year" id="expiration-year" name="expiration-year">
                                                @for($i = date('Y'); $i <= (date('Y') + 15); $i++)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="input-group mb-3">
                                    <img class="author_img" src="{{ asset('images/gateway/visa.png') }}" id="visa">
                                    <img class="author_img" src="{{ asset('images/gateway/mastercard.jpg') }}" id="mastercard">
                                    <img class="author_img" src="{{ asset('images/gateway/american-express.png') }}" id="amex">
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