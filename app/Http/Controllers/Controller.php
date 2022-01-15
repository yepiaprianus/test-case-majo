<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function successWithMessage($message)
    {
        return response()->json(
            [
                'code' => 1,
                'status' => 200,
                'message' => $message,
                'data' => null
            ]
        );
    }

    public function successWithData($data)
    {
        return response()->json(
            [
                'code' => 1,
                'status' => 200,
                'message' => "Success",
                'data' => $data
            ]
        );
    }

    public function errorWithmessage($msg)
    {

        return response()->json(
            [
                "code" => 0,
                "status" => false,
                "error" => null,
                "message" => $msg,
                'data' => null,
            ],
            200
        );
    }

    public function replace_path_img($path)
    {
        $src = str_replace(public_path(), url('/'), $path);
        return $src;
    }

    public function get_fist_by_id($tb, $id)
    {
        $ret = DB::table($tb)->first();
        if ($ret) {
            return $ret;
        }
        return false;
    }
}
