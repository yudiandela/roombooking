<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
class Room extends Model
{
    protected $table = 'rooms';
    use SoftDeletes;
    public function area(){
        return $this->belongsTo(Area::class)->withTrashed();
    }
    public function facility(){
        return $this->hasMany(Facility::class);
    }
    protected $fillable =[
        'facility_id',
        'area_id',
        'name',
        'description',
        'capacity',
        'contact_name',
        'contact_email',
        'contact_hp',
        'photo',
        'is_active',
    ];

}
