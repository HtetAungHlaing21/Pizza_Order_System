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
    public function delete($id)
    {
        $admin = User::where('id', $id)->first();
        $adminImage = $admin->image;
        if ($adminImage != null) {
            Storage::delete('public/' . $adminImage);
        }
        User::where('id', $id)->delete();
        return back()->with(['deleteSuccess' => 'Successfully Deleted!']);
    }

    //Remove Admin Role
    public function roleChange($id)
    {
        $data = ['role' => 'user'];
        User::where('id', $id)->update($data);
        return redirect()->route('account#adminList')->with(['updateSuccess' => 'Successfully Removed From Admin Role!']);
    }

    //list customers
    public function userList()
    {
        //Show only users in data searching
        $users = User::when(request('key'), function ($query, $keyword) {
            return $query->where(function ($query) use ($keyword) {
                $query->orwhere('name', 'like', '%' . request('key') . '%')
                    ->orWhere('phone_number', 'like', '%' . request('key') . '%')
                    ->orWhere('email', 'like', '%' . request('key') . '%');
            })
                ->where('role', 'user');
        }, function ($query) {
            return $query->where('role', 'user');
        })->paginate(2);
        return view('Admin.Account.customerList', compact('users'));
    }

    //delete customers
    public function userDelete($id){
        $customer = User::where('id', $id)->first();
        $customerImage = $customer->image;
        if($customerImage != null){
            Storage::delete('public/'. $customerImage);
        }
        User::where('id', $id)->delete();
        return back()->with(['deleteSuccess'=>'Successfully Deleted!']);
    }

    //Upgrade to admin
    public function upgrade($id){
        User::where('id', $id)->update(['role'=>'admin']);
        return redirect()->route('account#userList')->with(['updateSuccess'=>'Successfully upgraded to Admin Role!']);
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
