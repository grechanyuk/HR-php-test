<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Grechanyuk\YandexWeather\Facades\YandexWeather;

class HomeController extends Controller
{
    public function index() {
        $data = [
            'weather' => YandexWeather::getWeather(53.25209, 34.37167)
        ];

        return view('front.index', $data);
    }
}
