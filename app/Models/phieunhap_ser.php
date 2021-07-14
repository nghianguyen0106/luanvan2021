<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class phieunhap_ser extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='phieunhap_ser';
    protected  $fillable=['serMa','pnMa','spMa'];
}
