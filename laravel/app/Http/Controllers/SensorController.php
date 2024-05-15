<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Sensor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SensorController extends Controller
{
    public function index()
    {
        $data = Sensor::orderBy('suhu','asc')->get();
        return response()->json([
            'status'=>true,
            'message'=>'Data ditemukan',
            'data'=>$data
        ], 200);
    }

    public function store(Request $request)
{

    $existingSensor = Sensor::first();

    if ($existingSensor) {
        $existingSensor->delete();
    }

    $dataSensor = new Sensor;

    $rules = [
        'suhu' => 'required',
        'kelembapan' => 'required',
        'api' => 'required',
        'asap' => 'required',
        'motion' => 'required',
        'pintu' => 'required',
        'buzzer' => 'required',
    ];

    $validator = Validator::make($request->all(), $rules);
    if ($validator->fails()) {
        return response()->json([
            'status' => false,
            'message' => 'Gagal memasukan data',
            'data' => $validator->errors()
        ]);
    }

    $dataSensor->id = 1;

    $dataSensor->suhu = $request->suhu;
    $dataSensor->kelembapan = $request->kelembapan;
    $dataSensor->api = $request->api;
    $dataSensor->asap = $request->asap;
    $dataSensor->motion = $request->motion;
    $dataSensor->pintu = $request->pintu;
    $dataSensor->buzzer = $request->buzzer;

    $post = $dataSensor->save();

    return response()->json([
        'status' => true,
        'message' => 'Sukses memasukan data'
    ]);
}

}
