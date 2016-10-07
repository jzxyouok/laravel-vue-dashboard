<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use Notifiable;

    /**
     * A Role may have many Permissions.
     * 
     * @return Illuminate\Database\Eloquent\Model\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
