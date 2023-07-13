<?php

namespace App\Http\Controllers;

use Storage;
use App\Models\Cart;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    //Home Page
    public function home()
    {
        $categories = Category::get();
        $products = Product::orderBy('created_at', 'desc')->get();
        $carts = Cart::where('user_id', Auth::user()->id)->get();
        return view('User.Home.home', compact('categories', 'products', 'carts'));
    }

    //Home page-category filter
    public function filter($id){
        $categories = Category::get();
        $products = Product::where('category_id', $id)->get();
        return view('User.Home.home', compact('categories', 'products'));
    }

    //Pizza Detials Page
    public function pizzaDetails($id){
        $pizzas = Product::get();
        $pizza = Product::where('id', $id)->first();
        return view('User.Home.details', compact('pizzas', 'pizza'));
    }

    //Details Page
    public function details()
    {
        return view('User.Account.details');
    }

    //Update Page
    public function updatePage()
    {
        return view('User.Account.update');
    }

    //Update
    public function update(Request $request, $id)
    {
        $this->checkValidation($request);
        $data = $this->getData($request);
        if ($request->hasFile('image')) {
            $imageName = uniqid() . $request->file('image')->getClientOriginalName();
            $user = User::where('id', $id)->first();
            $oldImageName = $user->image;
            if ($oldImageName != null) {
                Storage::delete('public/' . $oldImageName);
            }
            $data['image'] = $imageName;
            $request->file('image')->storeAs('public', $imageName);
        }
        User::where('id', $id)->update($data);
        return redirect()->route('account#details')->with(['updateSuccess'=>'Account Successfully Updated!']);
    }

    //Change Password Page
    public function changePasswordPage(){
        return view('User.Account.changePassword');
    }

    //Change Password
    public function changePassword(Request $request){
        $this->checkPasswordValidation($request);
        $oldPassword = Auth::user()->password;
        if (Hash::check($request->oldPassword, $oldPassword)){
            $data = [
                'password' => Hash::make($request->newPassword)
            ];
            User::where('id', Auth::user()->id)->update($data);
            Auth::logout();
            return redirect()->route('auth#loginPage')->with(['changeSuccess'=>'Password Successfully Changed! Log In with your new password.']);
        }
        return back()->with(['notMatch'=>'Old Password does not match! Try Again!']);
    }


    //check validation
    private function checkValidation($request)
    {
        Validator::make($request->all(), [
            'name' => 'required',
            'gender' => 'required',
            'phoneNumber' => 'required',
            'email' => 'required',
            'address' => 'required',
            'image' => 'mimes:png,jpeg,jpg,bmp,webp|file',
        ])->validate();
    }

    //Change array format
    private function getData($request)
    {
        return [
            'name' => $request->name,
            'gender' => $request->gender,
            'phone_number' => $request->phoneNumber,
            'email' => $request->email,
            'address' => $request->address,
        ];
    }

    //check password validation
    private function checkPasswordValidation($request)
    {
        Validator::make($request->all(), [
            'oldPassword' => ['required'],
            'newPassword' => ['required', Password::min(8)->mixedcase()->numbers()->symbols()],
            'confirmPassword' => 'required|min:8|same:newPassword',
        ])->validate();
    }
}
