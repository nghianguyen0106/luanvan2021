<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class donhang extends Model
{
    use HasFactory;
    protected $table='donhang';
    protected $primaryKey='hdMa';
    protected $fillable=['hdMa','khMa','adMa','vcMa','hdSoluongsp','hdTongtien','hdTinhtrang','hdSdtnguoinhan','hdDiachi','hdGhichu'];
}
