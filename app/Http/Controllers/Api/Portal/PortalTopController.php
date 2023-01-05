<?php

namespace App\Http\Controllers\Api\Portal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Area;
use App\Models\Prefecture;

class PortalTopController extends Controller
{
    public function top() {
        $areas = Area::all();
        $prefectures = Prefecture::all();
        $contents = ['areas' => $areas, 'prefectures' => $prefectures];
        return response()->json($contents);
    }
}
