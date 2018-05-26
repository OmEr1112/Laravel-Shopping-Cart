<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
  public function __construct() {
    $this->middleware('guest', ['except' => ['getIndex', 'getProfile', 'getLogout']]);
    $this->middleware('auth', ['only' => ['getProfile', 'getLogout']]);
  }

  

  public function getSignup() {
    return view('user.signup');
  }



  public function postSignup() {
    $this->validate(request(), [
      'email' => 'email|required|unique:users',
      'password' => 'required|min:4'
    ]);

    $user = new User([
      'email' => request('email'),
      'password' => bcrypt(request('password'))
    ]);

    $user->save();

    \Auth::login($user);

    if (\Session::has('oldUrl')) {
      $oldUrl = \Session::get('oldUrl');
      \Session::forget('oldUrl');
      return redirect()->to($oldUrl);
    }

    return redirect()->route('user.profile');
  }



  public function getSignin() {
    return view('user.signin');
  }



  public function postSignin() {
    $signinInfo = request()->validate([
      'email' => 'email|required',
      'password' => 'required|min:4'
    ]);

    if (\Auth::attempt($signinInfo)) {
      if (\Session::has('oldUrl')) {
        $oldUrl = \Session::get('oldUrl');
        \Session::forget('oldUrl');
        return redirect()->to($oldUrl);
      }
      return redirect()->route('user.profile');
    }

    return redirect()->back();
  }




  public function getProfile() {
    $orders = \Auth::user()->orders;
    $orders->transform(function($order, $key){
      $order->cart = unserialize($order->cart);
      return $order;
    });
    return view('user.profile', compact('orders'));
  }




  public function getLogout() {
    \Auth::logout();
    return redirect()->route('product.index');
  }
}
