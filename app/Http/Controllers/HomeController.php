<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Stripe\Charge;
use Stripe\Stripe;

class HomeController extends Controller
{
    public function index()
    {
        $user = User::where('usertype', 'user')->get()->count();
        $product = Product::all()->count();
        $order = Order::all()->count();
        $delivered = Order::where('status', 'delivered')->get()->count();
        return view('admin.index', compact('user', 'product', 'order', 'delivered'));
    }
    public function home()
    {
        $product = Product::all();

        if (Auth::id()) {
            $user = Auth::user();

            $user_id = $user->id;

            $count = Cart::where('user_id', $user_id)->count();
        } else {
            $count = '';
        }
        return view('home.index', compact('product', 'count'));
    }
    public function shop()
    {
        $product = Product::all();

        if (Auth::id()) {
            $user = Auth::user();

            $user_id = $user->id;

            $count = Cart::where('user_id', $user_id)->count();
        } else {
            $count = '';
        }
        return view('home.shop', compact('product', 'count'));
    }
    public function why()
    {
        if (Auth::id()) {
            $user = Auth::user();

            $user_id = $user->id;

            $count = Cart::where('user_id', $user_id)->count();
        } else {
            $count = '';
        }
        return view('home.why', compact('count'));
    }
    public function testimonial()
    {
        if (Auth::id()) {
            $user = Auth::user();

            $user_id = $user->id;

            $count = Cart::where('user_id', $user_id)->count();
        } else {
            $count = '';
        }
        return view('home.testimonial', compact('count'));
    }
    public function contact_us()
    {
        if (Auth::id()) {
            $user = Auth::user();

            $user_id = $user->id;

            $count = Cart::where('user_id', $user_id)->count();
        } else {
            $count = '';
        }
        return view('home.contact_us', compact('count'));
    }
    public function login_home()
    {
        $product = Product::all();

        $user = Auth::user();

        $user_id = $user->id;

        $count = Cart::where('user_id', $user_id)->count();

        return view('home.index', compact('product', 'count'));
    }
    public function product_details($id)
    {
        $product = Product::find($id);

        $user = Auth::user();

        $user_id = $user->id;

        $count = Cart::where('user_id', $user_id)->count();

        return view('home.product_details', compact('product', 'count'));
    }
    public function add_cart($id)
    {
        $product_id = $id;
        $user_id = Auth::user()->id;
        $data = new Cart;
        $data->user_id = $user_id;
        $data->product_id = $product_id;
        $data->save();
        return response()->json(['success' => true]);
    }

    public function mycart()
    {
        if (Auth::id()) {
            $user_id = Auth::user()->id;

            $count = Cart::where('user_id', $user_id)->count();

            $cart = Cart::where('user_id', $user_id)->get();
        }
        return view('home.mycart', compact('count', 'cart'));
    }

    public function myorders()
    {
        if (Auth::id()) {
            $user_id = Auth::user()->id;
            $count = Cart::where('user_id', $user_id)->count();
            $order = Order::where('user_id', $user_id)->get();
        }
        return view('home.myorder', compact('order', 'count'));
    }
    public function delete_cart($id)
    {
        $data = Cart::find($id);
        $data->delete();
        return redirect()->back();
    }
    public function confirm_order(Request $request)
    {
        $name = $request->name;
        $address = $request->address;
        $phone = $request->phone;
        $user_id = Auth::user()->id;
        $cart = Cart::where('user_id', $user_id)->get();
        foreach ($cart as $item) {
            $data = new Order;
            $data->name = $name;
            $data->rec_address = $address;
            $data->phone = $phone;
            $data->user_id = $user_id;
            $data->product_id = $item->product_id;
            $data->save();
        }
        $cart_remove = Cart::where('user_id', $user_id)->get();
        foreach ($cart_remove as $item) {
            $data = Cart::find($item->id);
            $data->delete();
        }
        return redirect()->back();
    }
    public function stripe($value)
    {
        return view('home.stripe', compact('value'));
    }
    public function stripePost(Request $request, $value)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        Charge::create([
            "amount" => $value * 100,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Test payment from complete"
        ]);
        $name = Auth::user()->name;
        $phone = Auth::user()->phone;
        $address = Auth::user()->address;
        $user_id = Auth::user()->id;
        $cart = Cart::where('user_id', $user_id)->get();
        foreach ($cart as $item) {
            $data = new Order;
            $data->name = $name;
            $data->rec_address = $address;
            $data->phone = $phone;
            $data->user_id = $user_id;
            $data->product_id = $item->product_id;
            $data->payment_status = 'paid';
            $data->save();
        }
        $cart_remove = Cart::where('user_id', $user_id)->get();
        foreach ($cart_remove as $item) {
            $data = Cart::find($item->id);
            $data->delete();
        }
        toastr()
            ->timeOut(1000)
            ->addSuccess('Payment Successfullly.');
        return redirect()->back();
    }
}
