<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Whoops\Run;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(10);
        return view('admin.product.product', compact('products'));
    }
    public function create()
    {
        $categories = Category::all();
        $category = Category::first();
        return view('admin.product.create', compact('categories', 'category'));
    }
    public function store(Request $request)
    {
        if ($request->category_id == 'Null') {
            return redirect(route('product.create'))->with('error', 'Category cannot be empty, Please create your category');
        }
        $this->validate($request, [
            'category_id' => 'required',
            'img' => 'required|image|mimes:jpeg,png,jpg,svg',
            'name' => 'required',
            'condition' => 'required',
            'weight' => 'required|integer',
            'description' => 'required',
            'stock' => 'required',
            'price' => 'required|integer',
        ]);

        $img = $request->file('img');
        $filename = rand(0000, 9999) . '_' . $img->getClientOriginalName();
        $img->move('./image/admin/product', $filename);

        $request['image'] = $filename;
        $request['slug'] = Str::slug($request->name);

        Product::create($request->all());
        return redirect(route('product'))->with('success', 'Product created successfully');
    }
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.product.edit', compact('product', 'categories'));
    }
    public function update(Product $product, Request $request)
    {
        dd($product->all());
        if ($request->category_id == 'Null') {
            return redirect(route('product.edit', $product->slug))->with('error', 'Please select category');
        }
        $this->validate($request, [
            'category_id' => 'required',
            'img' => 'image|mimes:jpeg,png,jpg,svg',
            'name' => 'required',
            'condition' => 'required',
            'weight' => 'required|integer',
            'description' => 'required',
            'stock' => 'required|integer',
            'price' => 'required|integer',
        ]);
        if ($request->hasFile('img')) {
            unlink('./image/admin/product/' . $product->image);
            $img = $request->file('img');
            $filename = rand(0000, 9999) . '_' . $img->getClientOriginalName();
            $img->move('./image/admin/product', $filename);

            $product->image = $filename;
        }
        $product->slug = $request->name;
        $product->update($request->all());

        return redirect(route('product'))->with('success', 'Product edited successfully');
    }
    public function view(Product $product)
    {
        return view('admin.product.view', compact('product'));
    }
    public function delete(Product $product)
    {
        unlink('./image/admin/product/' . $product->image);
        $product->delete();
        return redirect(route('product'))->with('success', 'Product deleted successfully');
    }
}
