<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminOut extends Model
{
    use HasFactory;
    protected $fillable =[
    'timbangan_out_id','status'
    ];
}
