<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class imei extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='imei';
    protected $fillable=['spMa','imei'];
}
