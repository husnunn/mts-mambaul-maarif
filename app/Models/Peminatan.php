<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminatan extends Model
{
    protected $table = 'peminatan';

    protected $fillable = ['mata_pelajaran', 'jenis_peminatan', 'peminatan'];
}
