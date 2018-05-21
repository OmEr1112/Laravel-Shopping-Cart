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
        <fieldset>
          <div class="col-xs-12">
            <div class="form-group">
              <label for="name">Name</label>
              <input name="name" class="form-control" type="text" placeholder="Jane Doe" required="">
            </div>
          </div>
          <div class="col-xs-12">
            <div class="form-group">
              <label for="address">Address</label>
              <input name="address" class="form-control" id="address" type="text" placeholder="185 Berry St, California" required="">
            </div>
          </div>
          
        </fieldset>
        <fieldset>
          <div class="col-xs-12">
            <div class="form-group">
              <label for="card-el">Card Details</label>
              <div id="card-el"></div>
            </div>
          </div>
        </fieldset>
        <!-- Used to display form errors -->
        <div id="card-errors" role="alert"></div>

        {{ csrf_field() }}

        <input type="submit" id="submitbtn" class="submit btn btn-success" value="Buy Now">
      </form>

    </div>
  </div>

@endsection

@section('scripts')
  <script src="https://js.stripe.com/v3/"></script>
  <script src="{{ URL::to('/js/app.js') }}"></script>
@endsection