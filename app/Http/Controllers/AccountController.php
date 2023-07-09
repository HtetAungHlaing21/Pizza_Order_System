<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Storage;

class AccountController extends Controller
{
    //details page
    public function details()
    {
        return view('Admin.Account.details');
    }

    //Update Page
    public function updatePage()
    {
        return view('Admin.Account.update');
    }

    //Update
    public function update($id, Request $request)
    {
        $this->checkValidation($request);
        $data = $this->getData($request);

        //Image Update
        if ($request->hasFile('image')) {
            $imageName = uniqid() . $request->file('image')->getClientOriginalName();
            //Deleting the old image if exists
            $oldImageName = User::where('id', $id)->first();
            $oldImageName = $oldImageName->image;
            if ($oldImageName != null) {
                Storage::delete('public/' . $oldImageName);
            }
            $data['image'] = $imageName;
            $request->file('image')->storeAs('public', $imageName);
        }
        User::where('id', $id)->update($data);
        return redirect()->route('account#details')->with(['updateSuccess' => 'Account Details Updated']);
    }

    //Change Password Page
    public function changePasswordPage()
    {
        return view('Admin.Account.changePassword');
    }

    //Change Password
    public function changePassword(Request $request)
    {
        $this->checkPasswordValidation($request);
        $oldPassword = Auth::user()->password;
        if (Hash::check($request->oldPassword, $oldPassword)) {
            $newPassword = ["password" => Hash::make($request->newPassword)];
            User::where('id', Auth::user()->id)->update($newPassword);
            Auth::logout();
            return redirect()->route('auth#loginPage')->with(['changeSuccess' => 'Password Successfully Changed! Log In with your new password.']);
        }
        return redirect()->route('account#changePasswordPage')->with(['notMatch' => 'Old Password does not match! Try Again!']);
    }

    //Admin list page
    public function adminList()
    {
        //Show only admins in data searching
        $admins = User::when(request('key'), function ($query, $keyword) {
            return $query->where(function ($query) use ($keyword) {
                $query->orwhere('name', 'like', '%' . request('key') . '%')
                    ->orWhere('phone_number', 'like', '%' . request('key') . '%')
                    ->orWhere('email', 'like', '%' . request('key') . '%');
            })
                ->where('role', 'admin');
        }, function ($query) {
            return $query->where('role', 'admin');
        })->paginate(2);
        return view('Admin.Account.adminList', compact('admins'));
    }

    //Admin Delete
    public function delete($id){
        $admin = User::where('id', $id)->first();
        $adminImage = $admin->image;
        if($adminImage != null){
            Storage::delete('public/'.$adminImage);
        }
        User::where('id', $id)->delete();
        return back()->with(['deleteSuccess'=>'Successfully Deleted!']);
    }

    //Change role page
    public function changeRole($id){
        $admin = User::where('id', $id)->first();
        return view('Admin.Account.changeRole', compact('admin'));
    }

    //Change the role
    public function roleChange($id, Request $request){
        $data = ['role' => $request->role];
        User::where('id', $id)->update($data);
        return redirect()->route('account#adminList')->with(['updateSuccess'=>'Role Successfully Updated!']);
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
