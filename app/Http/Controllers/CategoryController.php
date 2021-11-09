<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::paginate(10);
        return view('admin.category.category', compact('categories'));
    }
    public function create(){
        return view('admin.category.create');
    }
    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'img' => 'required|image'
        ]);

        $img = $request->file('img');
        $filename = rand(0000, 9999) . '-' . $img->getClientOriginalName();
        $img->move('./image/admin/category' , $filename);

        $request['icon'] = $filename;
        $request['slug'] = Str::slug($request->name);

        Category::create($request->all());
        return redirect(route('category'))->with('success', 'Category created successfully');
    }
    public function edit(Category $category){
        return view('admin.category.edit', compact('category'));
    }
    public function update(Category $category, Request $request){
        $this->validate($request, [
            'name' => 'required',
            'img' => 'image|mimes:jpeg,png,jpg,svg'
        ]);

        if($request->hasFile('img')){
            unlink('./image/admin/category/' . $category->icon);
            $img = $request->file('img');
            $filename = rand(0000, 9999) . '-' . $img->getClientOriginalName();
            $img->move('./image/admin/category' , $filename);

            $category->icon = $filename;
        }
        $category->slug = Str::slug($request->name);
        $category->update($request->all());
        return redirect(route('category'))->with('success', 'Category updated successfully');
    }
    public function delete(Category $category){
        unlink('./image/admin/category/' . $category->icon);
        $category->delete();
        return redirect(route('category'))->with('success', 'Category deleted successfully');
    }
}
