<?php

namespace App\Models;

use Zizaco\Entrust\EntrustRole;
use App\Models\Permission;
class Role extends EntrustRole
{
    protected $table = 'role';
    protected $fillable =[
        'name',
        'display_name',
        'description',
    ];
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
}

