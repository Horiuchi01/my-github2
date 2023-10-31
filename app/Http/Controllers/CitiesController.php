<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Support\Facades\Auth;

class CitiesController extends Controller
{
    public function dashboard()
    {
        $userId = Auth::id();

        $cities = City::whereHas('users', function ($query) use ($userId) {
            $query->where('id', $userId);
        })->with('users')->get();

        return view('dashboard', ['cities' => $cities]);
    }
}
