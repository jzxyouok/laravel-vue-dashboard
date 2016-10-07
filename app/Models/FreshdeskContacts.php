<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class FreshdeskContacts extends Model
{
    use Notifiable;

    /**
     * The database connection
     *
     * @var array
     */
    protected $connection = 'vub';

    /**
     * The table name
     *
     * @var string
     */
    protected $table = 'freshdesk_contacts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

}
