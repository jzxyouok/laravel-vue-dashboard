<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class BillPayCompany extends Model
{
    use Notifiable;
    
	/**
	 * The database connection
	 *
	 * @var array
	 */
    protected $connection = 'billpay';

    /**
	 * The table name
	 *
	 * @var string
	 */
	protected $table = 'company';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['CompanyId'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * A Company is comprised of many Transactions.
     * 
     * @return Illuminate\Database\Eloquent\Model\HasMany
     */
    public function payments()
    {
        return $this->hasMany(Payment::class, 'CompanyId', 'Id');
    }
}
