<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Area extends Model
{
    use SoftDeletes;
    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function reservation()
    {
        return $this->hasMany(Reservation::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class)->withTrashed();
    }

    protected $table = 'areas';
    protected $fillable =[
        'name',
        'description',
        'unit_id',
    ];
    protected $dates = ['deleted_at'];
}
