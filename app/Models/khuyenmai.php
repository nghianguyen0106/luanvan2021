<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class khuyenmai extends Model
{
    use HasFactory;
    protected $table='khuyenmai';
    protected $primaryKey='kmMa';
    protected $fillable=['kmMa','kmTen','kmMota','kmTrigia','kmNgaybt','kmNgaykt','kmSoluong','kmGiatritoida',];
}
