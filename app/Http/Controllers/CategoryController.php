<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;


class CategoryController extends Controller
{

    public function index()
    {
        return view('admin.pages.category.index');
    }

    public  function submit_category(Request $request)
    {
        $msg = null;
        if ($request->id) {
            DB::table('master_category')->where('id', $request->id)->update(['category_name' => $request->category_name]);
            $msg = "Berhasil update data";
        } else {
            DB::table('master_category')->insert(['category_name' => $request->category_name]);
            $msg = "Berhasil insert data";
        }
        return $this->successWithMessage($msg);
    }

    public function get_all_category(Request $request)
    {
        $data = DB::table('master_category')->where('flag', 1)->orderBy('created_at', 'desc')->get();

        if ($request->ajax()) {
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '
                        <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id .
                        '" data-original-title="Edit" class="btn-icon btn btn-primary btn-sm btn-round mr-1 mb-1 waves-effect waves-light" onclick=view_category(' . $row->id . ')>
                        <i class="feather icon-edit" aria-hidden="true"></i>
                        </a>
                        <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id .
                        '"data-original-title="Delete" class="btn-icon btn btn-danger btn-sm btn-round mr-1 mb-1 waves-effect waves-light" onclick=deleteCategory(' . $row->id . ')>
                        <i class="feather icon-delete" aria-hidden="true"></i></a>                        
                        ';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function delete($id)
    {
        DB::table('master_category')->where('id', $id)->update(['flag' => 2]);
        return $this->successWithMessage("Berhasil menghapus data");
    }

    public function view($id)
    {
        $data = DB::table('master_category')->where('id', $id)->first();
        return $this->successWithData($data);
    }

    public function test_menu()
    {
        $kategori = DB::table('master_category')
            ->where('flag', 1)
            ->select('id', 'category_name')
            ->groupBy('id')
            ->get();

        $menu = [];
        $sub_menu = [];

        $def = [
            'id' => "",
            'name' => ""
        ];

        for ($i = 0; $i < count($kategori); $i++) {
            if ($i < 4) {
                array_push($menu, $kategori[$i]);
            }
            if ($i >= 4) {
                array_push($sub_menu, $kategori[$i]);
            }
        }
        foreach ($menu as $key => $value) {
            $data_menus = [];

            foreach ($sub_menu as $key_sub) {
                array_push($data_menus, $key_sub);
            }

            if (count($data_menus) < 3) {
                $menu[$key]->sub_menu = [$data_menus[$key]];
            }
            if (count($data_menus) > 3) {
                $menu[$key]->sub_menu = [$data_menus[$key], $data_menus[($key + 4)] ?? null];
            }
        }
        return $menu;

        // return $this->successWithData($menu);
    }
}
