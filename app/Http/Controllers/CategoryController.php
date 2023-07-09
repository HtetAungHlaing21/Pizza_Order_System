<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //List
    public function list(){
        $categories = Category::when(request('key'), function($query){
            $searchKey = request('key');
            $query->where('name', 'like', '%'.$searchKey.'%');
        })
        ->orderBy('created_at', 'desc')
        ->paginate(4);
        return view('Admin.Category.list',compact('categories'));
    }

    //Create page
    public function createPage(){
        return view('Admin.Category.create');
    }

    //Create Category
    public function create(Request $request){
        $this->checkValidation($request);
        $data = $this->getData($request);
        Category::create($data);
        return redirect()->route("category#list")->with(['createSuccess'=>'Category Created']);
    }

    //Delete category
    public function delete($id){
        Category::where('id', $id)->delete();
        return back()->with(['deleteSuccess' => "Category Deleted"]);
    }

    //Update page
    public function updatePage($id){
        $category = Category::where('id', $id)->first();
        return view('Admin.Category.update', compact('category'));
    }

    //Update category
    public function update(Request $request){
        $this->checkValidation($request);
        $data = $this->getData($request);
        Category::where('id', $request->id)->update($data);
        return redirect()->route('category#list')->with(['updateSuccess'=> 'Category Updated']);
    }

    //Validation check
    private function checkValidation($request){
        Validator::make($request->all(), [
            'categoryName' => 'required|unique:categories,name,'.$request->id
            ])->validate();
    }

    //Changing array format
    private function getData($request){
        return ["name" => $request->categoryName];
    }

}
