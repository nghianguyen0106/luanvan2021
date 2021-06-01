<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class khuyenmai_log extends Model
{
    use HasFactory;
    protected $table='khuyenmai_log';
    protected $fillable=['kmMa','kmgSolan','kmMa'];
}
