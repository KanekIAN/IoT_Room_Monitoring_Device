<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class SensorController1 extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $client = new Client();
        // $url = "http://192.168.18.5:8000/api/datasensor";


        // $url = "http://192.168.140.16:8000/api/datasensor";


        //Smartroom 
        // $url = "http://192.168.1.149:8000/api/datasensor";

        // Redmi Note 11
        // $url = "http://192.168.240.16:8000/api/datasensor";

        // Darren
        // $url = "http://192.168.214.16:8000/api/datasensor";

        //Emily
        $url = "http://192.168.199.16:8000/api/datasensor";

        // $url = "http://192.168.83.16:8000/api/datasensor";


        // $url = "http://192.168.11.116:8000/api/datasensor";


        // $url = "http://192.168.2.226:8000/api/datasensor";


        $response = $client->request('GET', $url);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        $data = $contentArray['data'];
        return view('index', ['data'=>$data]);
    }

}
