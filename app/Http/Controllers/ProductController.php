<?php

namespace App\Http\Controllers;

use Storage;
use App\Models\Rating;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //Product list
    public function list(){
        $pizzas = Product::when(request('key'), function($query){
            $query->orwhere('products.name', 'like', '%'.request('key').'%')
                ->orWhere('categories.name', 'like', '%'.request('key').'%');
        })
            ->select('products.*', 'categories.name as category_name')
            ->leftJoin('categories', 'products.category_id', 'categories.id')
            ->orderBy('products.updated_at', 'desc')->paginate(3);
        return view('Admin.Product.list', compact('pizzas'));
    }

    //Create page
    public function createPage(){
        $categories = Category::get();
        return view('Admin.Product.create', compact('categories'));
    }

    //Create
    public function create(Request $request){
        $this->checkValidation($request,"create");
        $data = $this->getData($request);
        $imageName =uniqid() . $request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('public', $imageName);
        $data['image'] = $imageName;
        Product::create($data);
        return redirect()->route('product#list')->with(['createSuccess'=>'Pizza Successfully Created!']);
    }

    //Delete
    public function delete($id){
        $product = Product::where('id', $id)->first();
        if ($product->image != null){
            Storage::delete('public/'. $product->image);
        }
        Product::where('id', $id)->delete();
        return back()->with(['deleteSuccess'=> 'Product Successfully Deleted!']);
    }

    //Details
    public function details($id){
        $pizza = Product::select('products.*', 'categories.name as category_name')
                ->leftJoin('categories', 'products.category_id', 'categories.id')
                ->where('products.id', $id)->first();
        $reviews = Rating::select('ratings.*', 'users.name', 'users.gender')
                ->leftJoin('users', 'users.id', 'ratings.user_id')
                ->where('ratings.product_id', $id)
                ->orderBy('ratings.created_at', 'desc')
                ->paginate(3);
        return view('Admin.Product.details', compact('pizza', 'reviews'));
    }

    //Update Page
    public function updatePage($id){
        $pizza = Product::where('id', $id)->first();
        $categories = Category::get();
        return view('Admin.Product.update',compact('pizza', 'categories'));
    }

    public function update(Request $request){
        $this->checkValidation($request, "update");
        $data = $this->getData($request);
        if ($request->hasFile('image')){
            $oldImageName = Product::where('id', $request->id)->first();
            $oldImageName = $oldImageName->image;
            if ($oldImageName != null){
                Storage::delete('public/' . $oldImageName);
            }
            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $data['image'] = $fileName;
            $request->file('image')->storeAs('public', $fileName);
        }
        Product::where('id', $request->id)->update($data);
        return redirect()->route('product#list')->with(['updateSuccess'=>'Pizza Successfully Updated']);
    }

    //Private Functions
    //Check Validation
    private function checkValidation($request, $mode){
        $validationRules = [
            "name" => 'required|min:5|unique:products,name,'.$request->id ,
            "category" => 'required',
            "description" => 'required|min:10',
            "price" => 'required',
        ];
        $validationRules["image"] = ($mode == "create")? 'required|mimes:bmp,jpg,jpeg,png,webp|file' : 'mimes:bmp,jpg,jpeg,png,webp|file';
        Validator::make($request->all(), $validationRules)->validate();
    }

    //Change Array Format
    private function getData($request){
        return [
            "name" => $request->name,
            "category_id" => $request->category,
            "description" => $request->description,
            "price" => $request->price,
            "waiting_time" => $request->waitingTime
        ];
    }
}
