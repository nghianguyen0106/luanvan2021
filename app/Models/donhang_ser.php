<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class donhang_ser extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='donhang_ser';
    protected  $fillable=['serMa','hdMa','spMa'];
}
