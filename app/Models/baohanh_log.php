<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class baohanh_log extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='baohanh_log';
    protected $fillable=['imeisp','bhNgay','khMa'];
}
