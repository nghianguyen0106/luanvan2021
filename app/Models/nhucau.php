<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nhucau extends Model
{
    use HasFactory;
    protected $table='nhucau';
    protected $primaryKey='ncMa';
    protected $fillable=['ncMa','ncTen'];
}
