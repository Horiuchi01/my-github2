<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Support\Facades\Auth;

class CitiesController extends Controller
{
    public function dashboard()
    {
        // 現在ログインしているユーザーのIDを取得
        $userId = Auth::id();

        // リレーションを使用して、関連するusersテーブルのデータも取得
        // ただし、現在ログインしているユーザーに関連するデータのみを取得
        $cities = City::whereHas('users', function ($query) use ($userId) {
            $query->where('id', $userId);
        })->with('users')->get();

        return view('dashboard', ['cities' => $cities]);
    }
}
