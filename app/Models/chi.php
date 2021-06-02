<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class chi extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='chi';
    protected $fillable=['chiNgaygiolap','chiSoluongsp','chiTongtien','chiNoidung','adMa'];
}
