<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function home()
    {
        $products = Product::join('master_category as mk', 'mk.id', '=', 'products.category_id')
            ->select(
                'products.id',
                'products.name',
                'products.price',
                'products.image',
                'products.description',
                'products.created_at',
                'mk.category_name'
            )
            ->orderBy('products.created_at', 'desc')
            ->get();
        foreach ($products as $key => $v) {
            $products[$key]->date =  Carbon::parse($v->created_at)->format('Y-m-d H:i:s');
            // $products[$key]->price = "Rp " . number_format($products[$key]->price, 0, ",", ".");
            $destinationPath = public_path() . '/uploads/product';
            $products[$key]->image = $this->replace_path_img($destinationPath . '/' . $v->image);
            unset($products[$key]->created_at);
        }
        return view('landing.home', ['data' => $products, 'login' => Session::get('login')]);
    }
}
