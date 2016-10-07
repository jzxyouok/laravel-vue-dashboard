<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_token', 'name', 'address_1', 'address_2', 'city', 'state', 'zip', 'phone',
    ];

    /**
     * A Company is comprised of many Users.
     * 
     * @return Illuminate\Database\Eloquent\Model\HasMany
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
