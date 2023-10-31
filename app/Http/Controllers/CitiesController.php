<?php

namespace App\Http\Controllers;

use App\Models\City;

class CitiesController extends Controller
{
    public function dashboard()
    {
        // リレーションを使用して、関連するusersテーブルのデータも取得
        $cities = City::with('users')->get();
        return view('dashboard', ['cities' => $cities]);
    }
}
