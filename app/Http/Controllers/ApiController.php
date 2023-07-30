<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    //Category list
    public function categoryList()
    {
        $categories = Category::orderBy('id', 'desc')->get();
        return response()->json($categories, 200);
    }

    //Category Search
    public function categorySearch($id)
    {
        $category = Category::where('id', $id)->first();
        if (isset($category)) {
            return response()->json($category, 200);
        }
        return response()->json([
            'status' => 'Fail',
            'message' => 'Category Not Found',
        ], 404);
    }

    //Category Create
    public function categoryCreate(Request $request)
    {
        if ($this->checkValidation($request)) {
            $category = $this->getData($request);
            $data = Category::create($category);
            return response()->json([
                'message' => 'Category Created',
                'new category' => $data,
            ], 200);
        }
        return response()->json([
            "message" => 'Validation Failed',
        ], 422);
    }

    //Category Delete
    public function categoryDelete($id)
    {
        $category = Category::where('id', $id)->first();
        if (isset($category)) {
            Category::where('id', $id)->delete();
            return response()->json([
                "message" => "Category Deleted",
                "deleted category" => $category,
            ], 200);
        }
        return response()->json([
            "message" => "Category Not Found",
        ], 404);
    }

    //Category Update
    public function categoryUpdate(Request $request)
    {
        $category = Category::where('id', $request->categoryID);
        if (isset($category)) {
            if ($this->checkValidation($request)) {
                $data = $this->getData($request);
                Category::where('id', $request->categoryID)->update($data);
                $updateData = Category::where('id', $request->categoryID)->get();
                return response()->json([
                    "message" => "Category Updated",
                    "updated category" => $updateData,
                ], 200);
            }
            return response()->json([
                "message" => "Validation Failed",
            ], 404);

        }
        return response()->json([
            "message" => "Category Not Found",
        ], 404);
    }

    //Category Private functions
    //Validation Check
    private function checkValidation($request)
    {
        try {
            Validator::make($request->all(), [
                'categoryName' => 'required|unique:categories,name,' .$request->categoryID,
            ])->validate();
            return true;
        } catch (\Illuminate\Validation\ValidationException $e) {
            return false;}
    }

    //Changing array format
    private function getData($request)
    {
        return ["name" => $request->categoryName];
    }
}
