<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Xray extends Model
{
    use HasFactory;
     protected $table = 'xray_results';

    protected $guarded=[];
}
