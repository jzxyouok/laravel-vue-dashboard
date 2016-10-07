<?php

namespace App\Models;

trait HasRoles
{
    /**
     * A User may have many Roles.
     * 
     * @return Illuminate\Database\Eloquent\Model\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Determine if User has specified Role
     * 
     * @return boolean
     */
    public function hasRole($role)
    {
        if (is_string($role)) {
            return $this->roles->contains('name', $role);
        }

        return !! $role->intersect($this->roles)->count();
    }

    /**
     * Assign specified Role to User
     * 
     * @param  string  $role
     * @return void
     */
    public function assignRole($role)
    {
        return $this->roles()->save(
            Role::where('name', $role)->firstOrFail()
        );
    }
}