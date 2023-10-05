<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EcomUser;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\DB;

class userController extends Controller
{
    public function login()
    {
        //the function will be called by the url / but it will check if user is loged in alraedy it will take the usr 
        //to the welcome page otherwise to the login page
        if (session()->has('user_id')) {
            return redirect('welcome');
        }
        return view('login');
    }
    public function registerPage()
    {
        return view('register');
    }
    public function saveUser(Request $request)
    {
        $validatedData = $request->validate([
            'userName' => 'required|string|min:6|max:255',
            'Email' => 'required|string|email|unique:users|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);


        $user = new EcomUser($validatedData);
        $user->name = $request['userName'];
        $user->email = $request['Email'];
        $user->user_role = 2;
        $user->password = bcrypt($request['password']);
        $user->save();
        if($user->save()){
            return redirect('/')->with('success', 'User added successfully.');
        }
        else{
            return redirect()->back()->withErrors($user->getErrors())->withInput(); 
        }
        
    }
    public function loginUser(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        // Check if a user with the provided email exists in the database
        $user = DB::table('ecom_users')->where('email', $email)->first();

        if ($user && password_verify($password, $user->password)) {
            // Authentication passed
            session(['user_id' => $user->id]);
            session(['user_role' => $user->id]);
            // dd( session('user_id'));
            return redirect('welcome'); // Redirect to a protected page after successful login
        }

        // Authentication failed
        $errorMessage = 'Invalid credentials';

        // Pass the error message to the view
        return view('login', ['errorMessage' => $errorMessage]);
    }


    ///***************************Product Functions ***************************************************** */
    public function addProduct(Request $request)
    {

        // Handle the image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('product_images', 'public');
        } else {
            $imagePath = null; // No image provided
        }


        // Create a new product record
        $product = new Product;
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->image_path = $imagePath; // Store the image path in the database

        // Set other product attributes as needed
        $product->save();

        // Return a response (you can customize this)
        return response()->json(['message' => 'Product added successfully']);
    }

    public function showAllProducts()
    {
        if (session()->has('user_id')) {
            $user_id = session('user_id');
            $products = Product::all();
            $count = cart::where('user_id', $user_id)->count();
            return view('welcome', compact('products', 'count'));
        }
        return redirect('/');

    }
    function addToCart(Request $req)
    {
        if ($req->session()->has('user_id')) {
            $uid = session('user_id');
            $user_id = $uid;
            $product_id = $req->product_id;
            $quantity = $req->qty;
           
            $existingCart = Cart::where('user_id', $user_id)
            ->where('product_id', $product_id)
            ->first();
            if($existingCart){
                $existingCart->update(['quantity' => $quantity]);
            }
            else{
                $cart = new Cart;
                $cart->user_id = $uid;
                $cart->product_id = $req->product_id;
                $cart->quantity = $req->qty;
                $cart->save();
            }           
            return redirect('/welcome');
        } else {
            return redirect('login');
        }
    }

    function usersCartItems()
    {
        $uid = session('user_id');
        $data = DB::table('cart')
            ->join('products', 'cart.product_id', '=', 'products.id')
            ->select('cart.*', 'products.*', 'cart.id as cart_id')
            ->where('cart.user_id', $uid)
            ->get();

        return view('cart', ['products' => $data]);

    }

    function removeProduct($id)
    {
        Product::destroy($id);
        return redirect('welcome');
    }
    function removeFromCart($id)
    {
        Cart::destroy($id);
        return redirect('/cartView');
    }

    function orderNow()
    {
        $uid = session('user_id');

        $cartItems = DB::table('cart')
        ->join('products', 'cart.product_id', '=', 'products.id')
        ->select('cart.*', 'products.*')
        ->get();

        $total = DB::table('cart')
            ->join('products', 'cart.product_id', 'products.id')
            ->where('cart.user_id', $uid)
            ->sum(DB::raw('products.price * cart.quantity'));
        return view('orderNow', ['total' => $total ,'cartItems' => $cartItems]);
    }


}