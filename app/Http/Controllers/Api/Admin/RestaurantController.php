<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\UseCases\Restaurant\RegisterFetch;
use App\UseCases\Restaurant\RegisterPost;
use App\UseCases\Restaurant\InitializeFetch;
use App\UseCases\Restaurant\List;
use App\UseCases\Restaurant\Information;

class RestaurantController extends Controller
{
    public function registerFetch(Request $req)
    {
        $obj = new RegisterFetch;
        $res = $obj();
        return response()->json($res);
    }
    public function register(Request $req)
    {
        $obj = new RegisterPost;
        $res = $obj($req);
        return response()->json($res);
    }

    public function initializeFetch(Request $req)
    {
        $obj = new InitializeFetch;
        $res = $obj($req);
        return response()->json($res);
    }

    public function information(Request $req)
    {
        $obj = new Information;
        $res = $obj($req);
        return response()->json($res);
    }

    public function display_change(Request $req)
    {
        $req->session()->put('active_restaurant_id', $req['id']);
        $new_session = $req->session()->get('active_restaurant_id', $req['id']);
        $res = ['newSession' => $new_session];
        return response()->json($res);
    }

    public function imageUpload(Request $req) {
        // \Log::info($req);
        try {
            preg_match('/data:image\/(\w+);base64,/', $req['file'], $matches);
            $extension = $matches[1];

            $img = preg_replace('/^data:image.*base64,/', '', $req['file']);
            $img = str_replace(' ', '+', $img);
            $fileData = base64_decode($img);

            $dir = storage_path() . '/app/images/';
            $fileName = md5($img);
            $path = $dir.$fileName.'.'.$extension;
            if(!file_exists($dir)) mkdir($dir, 0777, true);
            file_put_contents($path, $fileData);
            $resize_image = \Image::make($path)->crop($req['backCrop']['width'], $req['backCrop']['height'], $req['backCrop']['x'], $req['backCrop']['y'])->save($path);

            return $path;

        } catch (Exception $e) {
            Log::error($e);
            return null;
        }
        $res = ['msg' => 'msg'];
        return response()->json($res);
    }
}
