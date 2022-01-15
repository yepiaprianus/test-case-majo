<?php

namespace App\Http\Controllers;

// use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Datatables;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.pages.users.index');
    }

    public function create()
    {
        $role = DB::table('master_role')->select('role_id', 'role_name')->get();
        return view('admin.pages.users.create', ['data' => $role]);
    }

    public function edit($id)
    {
        $data = DB::table('users as u')
            ->join('master_role as r', 'r.role_id', '=', 'u.role')
            ->select("u.id", "u.name", "u.email", "u.username", "u.photo", 'u.role')
            ->where('u.id', $id)
            ->groupBy('u.id')
            ->first();
        $role = DB::table('master_role')->select('role_id', 'role_name')->get();

        $data = [
            'users' => $data,
            'role' => $role
        ];
        return view('admin.pages.users.edit', $data);
    }

    public function simpan_users(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'email' => 'required|unique:users|:150',
                'name' => 'required',
                'role' => 'required'
            ]);

            if ($validator->fails()) {             
                return $this->errorWithmessage($validator->errors()->all());
            }

            $email = $request->email;
            $name = $request->name;
            $role = $request->role;

            $username = strtolower(str_replace(" ", "_", $name)) . rand(10, 10000);

            $insert = [
                'name' => $name,
                'role' => $role,
                'email' => $email,
                'photo' => 'avatarDefault.png',
                'username' => $username,
                'password' => bcrypt($username),
                'status' => 1
            ];

            if (DB::table('users')->insert($insert)) {
                return $this->successWithMessage('Berhasil insert data');
            }
            return $this->errorWithmessage(["Gagal menyimpan data"]);
        }
    }

    public function get_all_users(Request $request)
    {
        $id = Session::get('id');
        $data = DB::table('users as u')
            ->join('master_role as r', 'r.role_id', '=', 'u.role')
            ->select("u.id", "u.name", "u.email", "u.username", "u.photo", 'r.role_name')
            ->where('u.id', '!=', $id)
            ->orderBy('u.id', 'desc')
            ->groupBy('u.id')
            ->get();

        $destinationPath = public_path() . '/uploads/photo_profile';
        foreach ($data as $key => $value) {
            $src = $destinationPath . '/' . $value->photo;
            $data[$key]->photo = str_replace(public_path(), url('/'), $src);
        }

        if ($request->ajax()) {
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '
                        <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id .
                        '" data-original-title="View" class="btn-icon btn btn-primary btn-sm btn-round mr-1 mb-1 waves-effect waves-light" onclick=view_user(' . $row->id . ')>
                        <i class="feather icon-eye" aria-hidden="true"></i>
                        </a>
                        <a href="' . url('users/edit/' . $row->id) . '" data-toggle="tooltip"  data-id="' . $row->id .
                        '" data-original-title="Edit" class="btn-icon btn btn-info btn-sm btn-round mr-1 mb-1 waves-effect waves-light">
                        <i class="feather icon-edit" aria-hidden="true"></i></a>

                        <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id .
                        '"data-original-title="Delete" class="btn-icon btn btn-danger btn-sm btn-round mr-1 mb-1 waves-effect waves-light" onclick=deleteUser(' . $row->id . ')>
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
        DB::table('users')->where('id', $id)->delete();
        return $this->successWithMessage("Berhasil hapus data");
    }

    function get_user_by_id($id)
    {
        $data = DB::table('users as u')
            ->join('master_role as r', 'r.role_id', '=', 'u.role')
            ->select("u.id", "u.name", "u.email", "u.username", "u.photo", 'r.role_name')
            ->where('u.id', $id)
            ->groupBy('u.id')
            ->first();
        return $this->successWithData($data);
    }
    public function update_users(Request $request)
    {
        $email = $request->email;
        $name = $request->name;
        $role = $request->role;
        $id = $request->id_users;

        $update = [
            'name' => $name,
            'role' => $role,
            'email' => $email
        ];

        $update_user = DB::table('users')->where('id', $id)->update($update);

        if ($update_user) {
            return $this->successWithMessage("Berhasil update data");
        } else {
            return $this->errorWithmessage("Gagal update data");
        }
    }
}
