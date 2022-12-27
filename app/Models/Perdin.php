<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Perdin extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'perdin';

    protected $guarded = ['id','created_at','updated_at','deleted_at'];

    public function kotaasal()
    {
        return $this->belongsTo(MasterKota::class,'kota_asal','id');
    }

    public function kotatujuan()
    {
        return $this->belongsTo(MasterKota::class,'kota_tujuan','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}