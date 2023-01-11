<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Area;
use App\Models\Prefecture;
use App\Models\MainCategory;
use App\Models\SubCategory;
use App\Models\Budget;

class CommonController extends Controller
{
    //
    public function saveFileDrive()
    {
        $save_dir = config('app.save_dir');
        if ($save_dir) return $save_dir;
        return storage_path() . '/app/images/';
    }
    public function changeAlias($array)
    {
        $return_array = [];
        foreach ($array as $module) {
            switch (!empty($module)) {
                case preg_match('/AR/', $module):
                    $id = Area::where('alias', $module)->select(['id', 'name'])->first();
                    $return_array['AR'] = $id['id'];
                    $return_array['AR_name'] = $id['name'];
                    break;
                case preg_match('/PR/', $module):
                    $id = Budget::where('alias', $module)->select(['id', 'price'])->first();
                    $return_array['PR'] = $id['id'];
                    $return_array['PR_price'] = $id['price'];
                    break;
                case preg_match('/MC/', $module):
                    $id = MainCategory::where('alias', $module)->select(['id', 'name'])->first();
                    $return_array['MC'] = $id['id'];
                    $return_array['MC_name'] = $id['name'];
                    break;
                case preg_match('/SC/', $module):
                    $id = SubCategory::where('alias', $module)->select(['id', 'name'])->first();
                    $return_array['SC'] = $id['id'];
                    $return_array['SC_name'] = $id['name'];
                    break;
                case preg_match('/PF/', $module):
                    $id = Prefecture::where('alias', $module)->select(['id', 'name'])->first();
                    $return_array['PF'] = $id['id'];
                    $return_array['PF_name'] = $id['name'];
                    break;
                default:
                    // 処理
            }
        }
        return $return_array;
    }
}
