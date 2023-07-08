<?php

namespace App\Http\Controllers;

use Storage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class AccountController extends Controller
{
    //details page
    public function details(){
        return view('Admin.Account.details');
    }

    //Update Page
    public function updatePage(){
        return view('Admin.Account.update');
    }

    public function update($id, Request $request){
        $this->checkValidation($request);
        $data = $this->getData($request);

        //Image Update
        if($request->hasFile('image')){
            $imageName = uniqid() . $request->file('image')->getClientOriginalName();
            //Deleting the old image if exists
            $oldImageName = User::where('id', $id)->first();
            $oldImageName = $oldImageName->image;
            if($oldImageName != null){
                Storage::delete('public/'. $oldImageName);
            }
            $data['image'] = $imageName;
            $request->file('image')->storeAs('public', $imageName);
        }
        User::where('id', $id)->update($data);
        return redirect()->route('account#details')->with(['updateSuccess'=>'Account Details Updated']);
    }

    public function changePasswordPage(){
        return view ('Admin.Account.changePassword');
    }

    public function changePassword(Request $request){
        $this->checkPasswordValidation($request);
        $oldPassword = Auth::user()->password;
        if (Hash::check($request->oldPassword, $oldPassword)){
            $newPassword = ["password" => Hash::make($request->newPassword)];
            User::where('id', Auth::user()->id)->update($newPassword);
            Auth::logout();
            return redirect()->route('auth#loginPage')->with(['changeSuccess'=>'Password Successfully Changed! Log In with your new password.']);
        }
        return redirect()->route('account#changePasswordPage')->with(['notMatch'=>'Old Password does not match! Try Again!']);
    }

    //check validation
    private function checkValidation($request){
        Validator::make($request->all(), [
            'name' => 'required',
            'gender' => 'required',
            'phoneNumber' => 'required',
            'email' => 'required',
            'address' => 'required',
            'image' => 'mimes:png,jpeg,jpg,bmp'
        ])->validate();
    }

    //Change array format
    private function getData($request){
        return [
            'name' => $request->name,
            'gender' => $request->gender,
            'phone_number' => $request->phoneNumber,
            'email' => $request->email,
            'address' => $request->address
        ];
    }

    //check password validation
    private function checkPasswordValidation($request){
        Validator::make($request->all(), [
            'oldPassword' =>['required'],
            'newPassword' =>['required', Password::min(8)->mixedcase()->numbers()->symbols()],
            'confirmPassword' => 'required|min:8|same:newPassword'
        ])->validate();
    }
}
