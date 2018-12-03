<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unit extends Model
{
    use SoftDeletes;
    protected $table = 'units';
    protected $fillable = [
        'name',
    ];
    public $timestamps = false;

    public function units()
    {
        return $this->hasMany(Area::class);
    }

    protected $dates = ['deleted_at'];

}
