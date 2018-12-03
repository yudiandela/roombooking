<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use App\Models\Role;
use App\Notifications\resetpasswordnotification;

class User extends Authenticatable
{
    use Notifiable;
    use EntrustUserTrait;

    protected $table = 'users';

    public function unit(){
        return $this->belongsTo(Unit::class)->withTrashed();
    }
    protected $fillable = [
        'name', 'email', 'password','unit_id','photo'
    ];
    protected $hidden = [
        'password', 'token','password_resets','remember_token',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
    public function post()
    {

        $this->hasmany(Reservation::class);
    }
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new resetpasswordnotification($token));
    }
}
