<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservation extends Model
{
    protected $table = 'reservations';

    public function room(){
        return $this->belongsTo(Room::class);
    }
    public function user(){
       return $this->belongsTo(User::class);
    }

    public function attend(){
        return $this->belongsToMany(User::class, 'reservations_users');
    }

    public function unit(){
       return $this->belongsTo(Unit::class);
    }
    protected $fillable =[
        'room_id',
        'user_id',
        'unit_id',
        'subject',
        'description',
        'start',
        'end',
        'type',
        'contact_hp',
        'contact_name',
        'contact_email',
        'manager_email',
        'created_at',
        'updated_at',
        'status',
        'reason',
    ];

}
