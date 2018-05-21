@extends('layouts.master')

@section('title')

Laravel Shopping Cart

@endsection

@section('content')
  <div class="row">
    <div class="col-sm-6 col-md-4 col-md-offset-4 col-sm-offset-3">
      <h1>Checkout</h1>
      <h4>Your Total: ${{ $total }}</h4>

      <form action="{{ route('checkout') }}" method="post" id="checkout-form">
        {{-- <div class="row"> --}}

          {{-- <div class="col-xs-12">
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" id="name" class="form-control" required>
            </div>
          </div>

          <div class="col-xs-12">
            <div class="form-group">
              <label for="address">Address</label>
              <input type="text" id="address" class="form-control" required>
            </div>
          </div>

          <div class="col-xs-12">
            <div class="form-group">
              <label for="card-name">Card Holder Name</label>
              <input type="text" id="card-name" class="form-control" required>
            </div>
          </div>

          <div class="col-xs-12">
            <div class="form-group">
              <label for="card-number">Credit Card Number</label>
              <input type="text" id="card-number" class="form-control" required>
            </div>
          </div>

          <div class="col-xs-12">
            <div class="row">

              <div class="col-xs-6">
                <div class="form-group">
                  <label for="card-expiry-month">Expiration Month</label>
                  <input type="text" id="card-expiry-month" class="form-control" required>
                </div>
              </div>

              <div class="col-xs-6">
                <div class="form-group">
                  <label for="card-expiry-year">Expiration Year</label>
                  <input type="text" id="card-expiry-year" class="form-control" required>
                </div>
              </div>

            </div>
          </div>

          <div class="col-xs-12">
            <div class="form-group">
              <label for="card-cvc">CVC</label>
              <input type="text" id="card-cvc" class="form-control" required>
            </div>
          </div>

        </div> --}}


  <div class="form-row">
    <label for="card-element">
      Credit or debit card
    </label>
    <div id="card-number" class="form-group">
      <!-- a Stripe Element will be inserted here. -->
    </div>
    <div id="card-expiry" class="form-group">
      <!-- a Stripe Element will be inserted here. -->
    </div>
    <div id="card-cvc" class="form-group">
      <!-- a Stripe Element will be inserted here. -->
    </div>

    <!-- Used to display form errors -->
    <div id="card-errors" role="alert"></div>
  </div>

  
        {{ csrf_field() }}

        <input type="submit" id="submitbtn" class="submit btn btn-success" value="Buy Now">

        {{-- <button id="submitbtn" type="submit" class="btn btn-success">Buy Now</button> --}}
      </form>

    </div>
  </div>

@endsection

@section('scripts')
  <script src="https://js.stripe.com/v3/"></script>
  <script src="{{ URL::to('/js/app.js') }}"></script>
@endsection