<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    //send message to admin
    public function message(){
        return view('User.Contact.message');
    }

    public function sendMessage(Request $request){
        $this->checkValidation($request);
        $data = $this->getData($request);
        Contact::create($data);
        return redirect()->route('user#home')->with(['createSuccess' => 'Message sent! Thanks for reaching out.']);
    }

    //Show message history
    public function history($id){
        $messages = Contact::where('user_id', $id)->get();
        return view('User.Contact.history', compact('messages'));
    }

    //Show message list in admin panel
    public function list(){
        $messages = Contact::when(request('key'), function($query){
            $searchKey = request("key");
            $query->where('name', 'like', '%'.$searchKey.'%');
        })
                ->paginate(3);
        return view('Admin.Contact.list', compact('messages'));
    }

    //Private Functions
    //Check Validation
    private function checkValidation($request){
        $validationRules = [
            "name" => 'required',
            "phone" => 'required',
            "email" => 'required',
            "message" => 'required',
        ];
        Validator::make($request->all(), $validationRules)->validate();
    }

    //Change Array Format
    private function getData($request){
        return [
            "user_id" => $request->userID,
            "name" => $request->name,
            "phone_number" => $request->phone,
            "email" => $request->email,
            "message" => $request->message
        ];
    }
}
