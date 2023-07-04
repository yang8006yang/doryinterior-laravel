<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type_id',
        'client',
        'location',
        'value',
        'photoby',
        'description',
        'moddt',
        'show',
        'master',
    ];

    function imgs() {
        return $this->hasMany(Img::class ,'id','prj_id');
    }
}
