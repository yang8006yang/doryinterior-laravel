<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Img extends Model
{
    use HasFactory;

    function project() {
        return $this->belongsTo(Project::class,'prj_id','id');
    }

    protected $fillable = [
        'master',

    ];
}
