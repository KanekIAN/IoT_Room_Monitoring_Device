<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sensor extends Model
{
    use HasFactory;

    protected $table = "sensordata";
    protected $primary = 'id';
    protected $fillable = ['suhu', 'kelembapan', 'api', 'asap', 'motion', 'pintu', 'buzzer'];
}
