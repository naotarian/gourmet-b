<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\UseCases\Restaurant\RegisterFetch;
use App\UseCases\Restaurant\RegisterPost;
use App\UseCases\Restaurant\InitializeFetch;
use App\UseCases\Restaurant\List;
use App\UseCases\Restaurant\Information;
use App\UseCases\Restaurant\Sales;
use App\UseCases\Restaurant\SalesUpdate;
use App\Http\Controllers\Api\CommonController;
//Models
use App\Models\Slide;

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

    public function sales_fetch(Request $req)
    {
        $obj = new Sales;
        $res = $obj($req);
        return response()->json($res);
    }
    public function update_sales(Request $req)
    {
        $obj = new SalesUpdate;
        $res = $obj($req);
        return response()->json($res);
        // return response()->json($res);
    }

    public function display_change(Request $req)
    {
        $req->session()->put('active_restaurant_id', $req['id']);
        $new_session = $req->session()->get('active_restaurant_id', $req['id']);
        $res = ['newSession' => $new_session];
        return response()->json($res);
    }

    public function imageUpload(Request $req)
    {
        try {
            if (!$req->session()->get('active_restaurant_id')) return;
            $store_id = $req->session()->get('active_restaurant_id');
            $admin_user = $req->user();
            //ファイルアップロードがある場合
            if ($req['file']) {
                $count = 0;
                foreach ($req['file'] as $key => $f) {
                    if (!$f) continue;
                    $count++;
                    preg_match('/data:image\/(\w+);base64,/', $f, $matches);
                    //拡張子
                    $extension = $matches[1];

                    $img = preg_replace('/^data:image.*base64,/', '', $f);
                    $img = str_replace(' ', '+', $img);
                    $fileData = base64_decode($img);
                    //file保存先
                    $common = new CommonController;
                    $save_dir = $common->saveFileDrive();
                    $dir = $save_dir . $admin_user->id . '/' . $store_id . '/';
                    //ファイル名を設定
                    $fileName = uniqid(rand());
                    //最終的な保存path
                    $path = $dir . $fileName . '.' . $extension;
                    //ディレクトリなければ作成
                    if (!file_exists($dir)) mkdir($dir, 0777, true);
                    //保存
                    file_put_contents($path, $fileData);
                    //crop
                    $resize_image = \Image::make($path)->crop($req['backCrop'][$key]['width'], $req['backCrop'][$key]['height'], $req['backCrop'][$key]['x'], $req['backCrop'][$key]['y'])->save($path);
                    //1枚目のアップロード画像
                    if ($count === 1) {
                        $slide = Slide::where('store_id', $store_id)->first();
                        if (!$slide) {
                            //新規レコード
                            $slide = new Slide;
                            $slide['store_id'] = $store_id;
                            $paths = [];
                        } else {
                            //既にある場合
                            $paths = $slide['image_path'];
                        }
                    }
                    $paths[$key] = $path;
                }
                //pathsで上書き
                $slide['image_path'] = $paths;
                $slide->save();
                //使用していない画像は削除
                foreach (glob($dir . '*') as $file) if (is_file($file) && !in_array($file, $paths)) unlink($file);
            }
            return $path;
        } catch (Exception $e) {
            Log::error($e);
            return null;
        }
        $res = ['msg' => 'msg'];
        return response()->json($res);
    }
}
