<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tthinh extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='tthinha';
    protected $fillable=['ttMa','ttHinh'];
}
