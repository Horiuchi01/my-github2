<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class CitiesController extends Controller
{
    public function dashboard()
    {
        $userCity = Auth::user()->userCity;

        return view('dashboard', ['userCity' => $userCity]);
    }
}