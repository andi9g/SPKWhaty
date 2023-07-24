<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class satuanM extends Model
{
    use HasFactory;
    protected $table = 'satuan';
    protected $primaryKey = 'idsatuan';
    protected $guarded = [];
}
