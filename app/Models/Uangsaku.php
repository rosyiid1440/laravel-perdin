<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Uangsaku extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'uang_saku';

    protected $guarded = ['id','created_at','updated_at','deleted_at'];
}