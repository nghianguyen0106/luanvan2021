<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class banner extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='banner';
    protected $primaryKey='bnMa';
    protected $fillable=['bnMa','bnTieude','bnVitri','bnHinh','bnNgay','kmMa'];
}
