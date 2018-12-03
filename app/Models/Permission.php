<?php

namespace App\Models;

use Zizaco\Entrust\EntrustPermission;
use App\Models\Role;

class Permission extends EntrustPermission
{
    protected $table = 'permission';
    protected $fillable =[
        'name',
        'display_name',
        'description',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
