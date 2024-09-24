<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    public $city="London";
    public $days=4;
    public function index(){
        $data=json_decode(file_get_contents("https://api.weatherapi.com/v1/forecast.json?key=4f7cd476b76b4b1b89d150530242009&q=London&days=5"),true);

        $city=[
            'name' => $data['location']['name'],
            'weather' => []
        ];
        foreach($data['forecast']['forecastday'] as $day){
            $city['weather'][] = [
                'date' => $day['date'],
                'temp' => $day['day']['avgtemp_c'],
                'wind' => $day['day']['maxwind_mph'],
                'humidity' => $day['day']['avghumidity'],
                'photo' => $day['day']['condition']['icon'],
                'text'=> $day['day']['condition']['text']
            ];
        }
        // dd($city);
        return view('index',compact('city'));
    }
    public function handleSubmit(Request $request){

        $request->validate([
            'city' => 'required'
        ],[
            'city.required' => 'Please enter your city!!!'
        ]);
        $url = "https://api.weatherapi.com/v1/forecast.json?key=4f7cd476b76b4b1b89d150530242009&q=".$request->get('city')."&days=5";

            $data=json_decode(file_get_contents($url),true);

            $city=[
                'name' => $data['location']['name'],
                'weather' => []
            ];
            foreach($data['forecast']['forecastday'] as $day){
                $city['weather'][] = [
                    'date' => $day['date'],
                    'temp' => $day['day']['avgtemp_c'],
                    'wind' => $day['day']['maxwind_mph'],
                    'humidity' => $day['day']['avghumidity'],
                    'photo' => $day['day']['condition']['icon'],
                    'text'=> $day['day']['condition']['text']
                ];
            }
            return view('index')->with('city', $city);
    }
}
