<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //direct category page
    public function index () {
        $category = Category::get();
        return view('admin.category.index',compact('category'));
    }

    //category create
    public function createCategory(Request $request){
        $validator = $this->categoryValidationCheck($request);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $this->getCategoryData($request);
        Category::create($data);
        return back()->with(['createSuccess'=> 'Category Created!']);
    }

    //delete category
    public function categoryDelete($id){
        Category::where('category_id',$id)->delete();
        return redirect()->route('admin#category');
    }

    //search category
    public function categorySearch(Request $request){
        $category = Category::where('title','LIKE','%'.$request->categorySearch.'%')->get();
        return view('admin.category.index',compact('category'));
    }

    //edit category
    public function categoryEditPage($id){
        $category = Category::get();
        $updateData = Category::where('category_id',$id)->first();
        return view('admin.category.edit',compact('category','updateData'));
    }

    //update category
    public function categoryUpdatePage($id,Request $request){
        $validator = $this->categoryValidationCheck($request);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $updateData = $this->getUpdateData($request);
        Category::where('category_id',$id)->update($updateData);
        return redirect()->route('admin#category');
    }

    //category validation check
    private function categoryValidationCheck($request){
        $validationRules = [
            'categoryName'=> 'required',
            'categoryDescription'=>'required',
        ];

        return Validator::make($request->all(),$validationRules);
    }

    //get update data
    private function getUpdateData($request){
        return [
            'title' => $request->categoryName,
            'description'=>$request->categoryDescription,
            'created_at'=> Carbon::now(),
            'updated_at'=>Carbon::now()
        ];
    }

    //get category data
    private function getCategoryData ($request){
        return [
            'title' => $request->categoryName,
            'description'=> $request->categoryDescription,
            'created_at'=> Carbon::now(),
            'updated_at'=>Carbon::now()
        ];
    }
}
