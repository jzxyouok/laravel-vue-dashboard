<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use Notifiable;

    /**
     * A Role belongs to many Permissions.
     * 
     * @return Illuminate\Database\Eloquent\Model\BelongsToMany
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    /**
     * Link a Role to a Permission,
     * 
     * @param  Permission $permission
     * @return [type]                 
     */
    public function givePermissionTo(Permission $permission)
    {
        return $this->permissions()->save($permission);
    }
}
