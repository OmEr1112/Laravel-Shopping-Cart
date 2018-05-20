<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use App\Product;
use App\Order;
use Stripe\{Stripe, Charge};
use Session;

class ProductController extends Controller
{
  public function __construct() {
    $this->middleware('auth', ['only' => ['getCheckout', 'postCheckout']]);
  }
  public function getIndex() {
    $products = \App\Product::all();
    return view('shop.index', compact('products')); 
  }

  public function getAddToCart(Request $request, $id) {
    $product = Product::find($id);
    $oldCart = Session::has('cart') ? Session::get('cart') : null;
    $cart = new Cart($oldCart);
    
    $cart->add($product, $product->id);

    $request->session()->put('cart', $cart);
    return redirect()->route('product.index');
  }

  protected function forgetCart($cart) {
    if(count($cart->items) > 0) {
      Session::put('cart', $cart);
    } else {
      Session::forget('cart');
    }
  }

  public function getReduceByOne($id) {
    $oldCart = Session::has('cart') ? Session::get('cart') : null;
    $cart = new Cart($oldCart);
    $cart->reduceByOne($id);

    $this->forgetCart($cart);

    return redirect()->route('product.shoppingCart');
  }

  public function getRemoveItem($id) {
    $oldCart = Session::has('cart') ? Session::get('cart') : null;
    $cart = new Cart($oldCart);
    $cart->removeItem($id);

    $this->forgetCart($cart);

    return redirect()->route('product.shoppingCart');
  }

  public function getCart() {
    if(!Session::has('cart')) {
      return view('shop.shoppingCart');
    }
    $oldCart = Session::get('cart');
    $cart = new Cart($oldCart);
    return view('shop.shoppingCart', ['products' => $cart->items, 'totalPrice' => $cart->totalPrice]);
  }

  public function getCheckout() {
    if(!Session::has('cart')) {
      return view('shop.shoppingCart');
    }
    $oldCart = Session::get('cart');
    $cart = new Cart($oldCart);
    $total = $cart->totalPrice;
    return view('shop.checkout', ['total' => $total]);
  }

  public function postCheckout(Request $request) {
    if(!Session::has('cart')) {
      return view('shop.shoppingCart');
    }
    $oldCart = Session::get('cart');
    $cart = new Cart($oldCart);

    Stripe::setApiKey(config('services.stripe.secret'));

    try {
      $charge = Charge::create(array(
        'amount' => $cart->totalPrice * 100,
        'currency' => 'usd',
        'source' => $request->input('stripeToken'),
        'description' => 'test charge'
      ));
      $order = new Order();
      $order->cart = serialize($cart);
      $order->name = $request->input('name');
      $order->address = $request->input('address');
      $order->payment_id = $charge->id;

      \Auth::user()->orders()->save($order);

    } catch (\Exception $e) {
      return redirect()->route('checkout')->with('error', $e->getMessage());
    }

    Session::forget('cart');
    return redirect()->route('product.index')->with('success', 'Purchase Successful! Thanks for buying. :)');
  }
}
