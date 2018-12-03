<?php

namespace App;

use illuminate\Database\Eloquent\Model;
use illuminate\Database\Eloquent\softDeletes;

use Illuminate\Http\Request;

class Facility extends Model
{
    protected $table = 'facilities';

    public $timestamps = false;

    public function room()
    {
        return $this->hasMany(Room::class);
    }

    protected $fillable = [
        'name',
    ];
}
