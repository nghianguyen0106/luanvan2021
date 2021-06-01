<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class danhgia extends Model
{
    use HasFactory;
    protected $table='danhgia';
    protected $primaryKey='dgMa';
    protected $fillable=['dgMa','khMa','spMa','dgNoidung','dgNgay','dgTrangthai'];
}
