<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class admin extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='admin';
    protected $primaryKey='adMa';
    protected $fillable=['adMa','adTen','adTaikhoan','adMatkhau','adSdt','adEmail','adQuyen','adHinh','adDiachi','adHinhcmnd'];
}
