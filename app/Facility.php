<?php

namespace App;

use illuminate\Database\Eloquent\Model;
use illuminate\Database\Eloquent\softDeletes;

use Illuminate\Http\Request;

class Facility extends Model
{
    protected $table = 'facilities';

    public $timestamps = false;

    public function rooms()
    {
        return $this->belongsToMany(Room::class);
    }

    protected $fillable = [
        'name',
    ];
}
