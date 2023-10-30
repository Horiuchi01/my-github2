<?php

namespace App\Http\Controllers;

use App\Http\Requests\CityRequest;
use App\Models\City;

class CityController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(CityRequest $request)
    {
        $city = new City;
        $city->city = $request->city();
        $city->latitude = $request->latitude();
        $city->longitude = $request->longitude();
        $city->save();
        return redirect()->route("dashboard");
    }
}
