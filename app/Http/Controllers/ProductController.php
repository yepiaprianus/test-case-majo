<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{

    public function get_category_name($id)
    {
        return Category::where('id', $id)
            ->select('category_name')
            ->first()->category_name;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.product.index');
    }

    public function datatable_product(Request $request)
    {
        if ($request->ajax()) {
            $data = Product::join('master_category as mk', 'mk.id', '=', 'products.category_id')
                ->select(
                    'products.id',
                    'products.name',
                    'products.price',
                    'products.created_at',
                    'mk.category_name'
                )
                ->orderBy('products.created_at', 'desc')
                ->get();
            foreach ($data as $key => $v) {
                $data[$key]->date =  Carbon::parse($v->created_at)->format('Y-m-d H:i:s');
                $data[$key]->price = "Rp " . number_format($data[$key]->price, 0, ",", ".");
                unset($data[$key]->created_at);
            }

            $count = count($data);
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . url('product/' . $row->id) . '" data-toggle="tooltip"  data-id="' . $row->id .
                        '"data-original-title="View" class="btn-icon btn btn-primary btn-sm btn-round mr-1 mb-1 waves-effect waves-light">
                            <i class="feather icon-eye" aria-hidden="true"></i>
                            </a>
                            <a href="' . url('product/' . $row->id . '/edit') . '" data-toggle="tooltip"  data-id="' . $row->id .
                        '"data-original-title="Edit" class="btn-icon btn btn-info btn-sm btn-round mr-1 mb-1 waves-effect waves-light">
                            <i class="feather icon-edit" aria-hidden="true"></i>
                            </a>                            
                            <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id .
                        '"data-original-title="Delete" class="btn-icon btn btn-danger btn-sm btn-round mr-1 mb-1 waves-effect waves-light" onclick="deleteProduct(' . $row->id . ')">
                            <i class="feather icon-delete" aria-hidden="true"></i></a> 
                        ';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->with('info', ['total' => $count])
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ret = $this->get_default_data();
        return view('admin.pages.product.create', $ret);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $imageName = $request->temp_img ? $request->temp_img : 'nodata.png';
        $id = $request->id;

        $validator = Validator::make($request->all(), [
            'name' => ['required', "string", Rule::unique('products')->ignore($request->id)],
            'price' => 'required|int',
            'product_description' => 'required',
            'category' => 'required|int',
            'product_image' => ['mimes:jpg,jpeg,png,bmp', Rule::requiredIf(!$request->id)],
        ]);

        if ($validator->fails()) {
            return $this->errorWithmessage($validator->errors()->all());
        }

        if ($request->hasFile('product_image')) {
            $image = $request->file('product_image');
            $imageName = md5($image->getClientOriginalName() . time()) . "." . $image->getClientOriginalExtension();
            $destinationPath = public_path() . '/uploads/product/';
            $image->move($destinationPath, $imageName);

            if ($request->temp_img) {
                $temp = $destinationPath . '' . $request->temp_img;
                if (file_exists($temp)) {
                    unlink($temp);
                }
            }
        }
        DB::beginTransaction();
        try {
            $product = [
                'name' => $request->name,
                'price' => $request->price,
                'category_id' => $request->category,
                'image' => $imageName,
                'description' => $request->product_description
            ];
            if ($request->id) {
                Product::where('id', $request->id)->update($product);
                $msg = 'Updated';
            } else {
                Product::create($product);
                $msg = 'Inserted';
            }
            DB::commit();
            return $this->successWithMessage($msg);
        } catch (\Throwable $err) {
            DB::rollBack();
            return $this->errorWithmessage($err->getMessage() . ' ' . $err->getLine());
        }
    }

    public function get_default_data()
    {
        $path = public_path() . '/uploads/product/nodata.png';
        $img_default = $this->replace_path_img($path);
        $kategori = DB::table('master_category')->select('id', 'category_name')->where('flag', 1)->get();
        $ret = [
            'kategori' => $kategori,
            'img_product' => $img_default
        ];
        return $ret;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $destinationPath = public_path() . '/uploads/product';
        $product->image = $this->replace_path_img($destinationPath . '/' . $product->image);
        $product->category_name = $this->get_category_name($product->category_id);
        return view('admin.pages.product.view', ['data' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $kategori = DB::table('master_category')->select('id', 'category_name')->where('flag', 1)->get();
        $destinationPath = public_path() . '/uploads/product';
        $product->img_old = $product->image;
        $product->image = $this->replace_path_img($destinationPath . '/' . $product->image);
        return view('admin.pages.product.edit', ['data' => $product, 'kategori' => $kategori],);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        try {
            $del = $product->delete();
            if ($del) {
                $destinationPath = public_path() . '/uploads/product/';
                $temp = $destinationPath . '' . $product->image;
                if (file_exists($temp)) {
                    unlink($temp);
                }
                return $this->successWithMessage("Successfully deleted product");
            }
        } catch (QueryException $err) {
            return $this->errorWithmessage("Failled " . $err->getMessage());
        }
    }
}
