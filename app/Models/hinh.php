<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hinh extends Model
{
    use HasFactory;
    protected $table='hinh';
    protected $fillable=['spMa','spHinh'];
}
