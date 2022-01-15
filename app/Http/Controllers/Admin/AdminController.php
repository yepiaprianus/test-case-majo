<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        $now = Carbon::now();
        $year = $now->format('Y');
        $month = $now->format('m');

        $count_year = Product::whereYear('created_at', '=', $year)
            ->count();
        $count_mount = Product::whereMonth('created_at', '=', $month)
            ->count();
        $count_today = Product::whereDate('created_at', '=', $now)
            ->count();

        $data = [
            'year' => $count_year,
            'month' => $count_mount,
            'today' => $count_today
        ];
        $products = Product::join('master_category as mk', 'mk.id', '=', 'products.category_id')
            ->select(
                'products.id',
                'products.name',
                'products.price',
                'products.created_at',
                'mk.category_name'
            )
            ->orderBy('products.created_at', 'desc')
            ->limit(5)
            ->get();
        foreach ($products as $key => $v) {
            $products[$key]->date =  Carbon::parse($v->created_at)->format('Y-m-d H:i:s');
            $products[$key]->price = "Rp " . number_format($products[$key]->price, 0, ",", ".");
            unset($products[$key]->created_at);
        }
        $data['product'] = $products;
        return view('admin.index', $data);
    }

    public function ganti_password()
    {
        $id = Session::get('id');
        return view('admin.ganti_password', ['id' => $id]);
    }


    public function cek_password(Request $request)
    {
        $id = $request->id;
        $oldPass = $request->password;

        $cek = DB::table('users')->select('password', 'id')->where('id', $id)->first();
        // foreach ($cek as $key) {
        if (!(Hash::check($oldPass, $cek->password))) {
            return response()->json(['status' => false]);
        } else {
            return response()->json(['status' => true, 'msg' => 'Ok']);
        }
        // }            
    }

    public function ganti_password_user(Request $request)
    {
        $password = $request->pass_baru;
        $id = $request->id_user;
        $update = DB::table('users')->where('id', $id)->update(['password' => bcrypt($password)]);
        if ($update) {
            return $this->successWithMessage("Berhasil update password");
        } else {
            return $this->errorWithmessage("gagal update password");
        }
    }
}
