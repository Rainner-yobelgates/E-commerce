<?php

namespace App\Http\Controllers;

use App\User;
use App\Invoice;
use App\Product;
use App\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $products = Product::paginate(24);
        $latest = Product::latest()->paginate(10);
        return view('user.home.home', compact('latest', 'products',));
    }
    public function search(Request $request)
    {
        $products = Product::where('name', 'LIKE', '%' . $request->keyword . '%')->get();
        foreach ($products as $product) {
            echo '<a class="list-group-item" href="/detail/' . $product->slug . '">' . $product->name . '</a>';
        }
    }
    public function products(Request $request)
    {
        if ($request->search) {
            $products = Product::where('name', 'LIKE', '%' . $request->search . '%')->get();
        } else if ($request->sort == 'latest') {
            $products = Product::latest()->get();
        } else if ($request->sort == 'az') {
            $products = Product::orderBy('name', 'ASC')->get();
        } else if ($request->sort == 'za') {
            $products = Product::orderBy('name', 'DESC')->get();
        } else if ($request->sort == 'low_price') {
            $products = Product::orderBy('price', 'ASC')->get();
        } else if ($request->sort == 'high_price') {
            $products = Product::orderBy('price', 'DESC')->get();
        } else if ($request->min && $request->max) {
            $products = Product::wherebetween('price', [$request->min, $request->max])->get();
        } else {
            $products = Product::all();
        }
        return view('user.products.products', compact('products'));
    }
    public function category(Category $category, Request $request)
    {
        if ($request->sort == 'latest') {
            $products = $category->products()->latest()->get();
        } else if ($request->sort == 'az') {
            $products = $category->products()->orderBy('name', 'ASC')->get();
        } else if ($request->sort == 'za') {
            $products = $category->products()->orderBy('name', 'DESC')->get();
        } else if ($request->sort == 'low_price') {
            $products = $category->products()->orderBy('price', 'ASC')->get();
        } else if ($request->sort == 'high_price') {
            $products = $category->products()->orderBy('price', 'DESC')->get();
        } else {
            $products = $category->products()->get();
        }
        return view('user.category.category', compact('category', 'products'));
    }
    public function detail(Product $product)
    {
        return view('user.detail.detail', compact('product'));
    }
    public function cart()
    {
        return view('user.cart.cart');
    }
    public function storeCart(Product $product, Request $request)
    {
        $cart = session('cart');
        if (!empty($cart[$product->id])) {
            return redirect(route('home'))->with("error", "Product has been added to cart");
        } else {
            if ($request->amount) {
                $cart[$product->id] = [
                    "id" => $product->id,
                    "image" => $product->image,
                    "slug" => Str::slug($product->name),
                    "name" => $product->name,
                    "amount" => $request->amount,
                    "price" => $product->price,
                    "weight" => $product->weight
                ];
            } else {
                $cart[$product->id] = [
                    "id" => $product->id,
                    "image" => $product->image,
                    "slug" => Str::slug($product->name),
                    "name" => $product->name,
                    "amount" => 1,
                    "price" => $product->price,
                    "weight" => $product->weight
                ];
            }
            session()->put('cart', $cart);
            return redirect(route('home'))->with("success", "Product successfully added to cart");
        }
    }
    public function updateAmount(Request $request)
    {
        if ($request->id && $request->amount) {
            $cart = session('cart');
            $cart[$request->id]["amount"] = $request->amount;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    }
    public function deleteCart(Request $request)
    {
        if ($request->id) {
            $cart = session('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }
    }
    public function checkout()
    {
        $url = 'https://api.rajaongkir.com/starter/province?key=1cb6ca038ddb281f174dbc4264474df0&id';
        $provinces = rajaongkir($url, 'GET',);

        if (session('cart')) {
            return view('user.checkout.checkout', compact('provinces'));
        } else {
            return redirect(route('home'));
        }
    }

    public function get_cities(Request $request)
    {
        $url = 'https://api.rajaongkir.com/starter/city?key=1cb6ca038ddb281f174dbc4264474df0&province=' . $request->province_id;
        $cities = rajaongkir($url, 'GET',);
        $result = '<option value="">Choose City</option>';

        foreach ($cities['results'] as $city) {
            $result .= '<option value="' . $city['city_id'] . '">' . $city['type'] . ' ' . $city['city_name'] . '</option>';
        }
        return response()->json(['result' => $result]);
    }

    public function get_subdistricts(Request $request)
    {
        $url = 'https://pro.rajaongkir.com/api/subdistrict?key=1cb6ca038ddb281f174dbc4264474df0&city=' . $request->city_id .'&id';
        $subdistricts = rajaongkir($url, 'GET',);
        $result = '<option value="">Choose Subdistrict</option>';

        foreach ($subdistricts['results'] as $subdistrict) {
            $result .= '<option value="' . $subdistrict['subdistrict_id'] . '">' . $subdistrict['subdistrict_name'] . '</option>';
        }
        return response()->json(['result' => $result]);
    }

    public function get_service(Request $request)
    {
        $jnt = get_courier(2121, $request->subdistrict_id, $request->weight, 'jnt');
        $jne = get_courier(2121, $request->subdistrict_id, $request->weight, 'jne');
        $pos = get_courier(2121, $request->subdistrict_id, $request->weight, 'pos');
        $tiki = get_courier(2121, $request->subdistrict_id, $request->weight, 'tiki');

        $list = '<option value="" hidden>Pilih Pengiriman</option>';

        if (count($jnt) > 0) {
            foreach ($jnt as $data) {
                // .= concat
                $list .= '<option value="' . $data['cost'][0]['value'] . "-" . $data['service'] . '-JNT">' . "JNT | " . " " . $data['description'] . " (" . $data['service'] . ")" . '</option>';
            };
        }

        if (count($jne) > 0) {
            foreach ($jne as $data) {
                $list .= '<option value="' . $data['cost'][0]['value'] . "-" . $data['service'] . '-JNE">' . "JNE | " . " " . $data['description'] . " (" . $data['service'] . ")" . '</option>';
            };
        }

        if (count($pos) > 0) {
            foreach ($pos as $data) {
                $list .= '<option value="' . $data['cost'][0]['value'] . "-" . $data['service'] . '-POS">' . "POS | " . " " . $data['description'] . " (" . $data['service'] . ")" . '</option>';
            };
        }

        if (count($tiki) > 0) {
            foreach ($tiki as $data) {
                $list .= '<option value="' . $data['cost'][0]['value'] . "-" . $data['service'] . '-TIKI">' . "TIKI | " . " " . $data['description'] . " (" . $data['service'] . ")" . '</option>';
            };
        }

        return response()->json(['list' => $list]);
    }

    public function get_courier(Request $request){
        $cost = explode("-", $request->courier);
        $subtotal = "<span'>Rp. ". number_format($cost[0] + $request->sub_price) ."</span>"; 
        return response()->json(['cost' => number_format($cost[0]), 'subtotal' => $subtotal]);
    }

    public function transaction(){
        $user = User::where('id', Auth::user()->id)->first();
        $invoices = Invoice::where('user_id', $user->id)->get();
        $check = Invoice::where('user_id', $user->id)->whereIn('status', [0,1,2,3])->first();
        return view('user.profile.transaction', compact('user', 'invoices', 'check'));
    }

    public function history(){
        $user = User::where('id', Auth::user()->id)->first();
        $invoices = Invoice::where('user_id', $user->id)->where('status', 4)->get();
        $check = Invoice::where('user_id', $user->id)->where('status', 4)->first();
        return view('user.profile.history', compact('user', 'invoices', 'check'));
    }

    public function view(Invoice $invoice){
        return view('user.profile.view', compact('invoice'));
    }
    public function update(Invoice $invoice){
        $invoice->update([
            'status' => 4
        ]);
        // $product = Product::where('id', $invoice->transactions->product_id)->update([
        //     "stok" => 'stock' - $invoice->transactions->amount 
        // ]);
        return redirect(route('transaction'))->with('success', 'Transaction has been completed');
    }
}
