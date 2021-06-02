<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class khachhang extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='khachhang';
    protected $primaryKey='khMa';
    protected $fillable=['khMa','khTen','khEmail','khSdt','khNgaysinh','khDiachi','khGioitinh','khHinh','khXtemail','khResetpassword','khNgaythamgia','khQuyen','khTaikhoan','khMatkhau'];
}
