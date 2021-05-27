@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Make a Payment') }}</div>

                <div class="card-body">
                    <form action="{{route('admin.pay')}}" method="post" id="paymentForm">
                        @csrf
                        <div class="row">
                            <div class="form-group col-6">
                                <label>
                                    <span>Product Title: </span>
                                    <strong>{{ $product->name }}</strong>
                                </label>
                                
                            </div>
                            <div class="form-group col-6">
                                <label for="currency">
                                    <span>Price: </span>
                                    <strong>${{ $product->price }}</strong>
                                    <input type="hidden" name="price" value="{{ $product->price }}">
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <x-admin.payment.stripe/>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block" id="payButton">Pay</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    
@endsection