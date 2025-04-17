<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class orders
 * @package App\Models
 * @version March 18, 2023, 3:01 am UTC
 *
 * @property string $number
 * @property string $date
 * @property integer $state
 * @property string $provider
 * @property string $store
 * @property number $delivery_costs
 * @property string $observations
 */
class orders extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'orders';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'number',
        'date',
        'state',
        'provider',
        'store',
        'delivery_costs',
        'observations',
        'id_user_master'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'number' => 'string',
        'date' => 'datetime',
        'state' => 'integer',
        'provider' => 'string',
        'store' => 'string',
        'delivery_costs' => 'double',
        'observations' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'number' => 'required',
        'date' => 'date',
        'state' => 'required',
        'provider' => 'required',
        'store' => 'required',
        'delivery_costs' => 'numeric',
        'observations' => 'required'
    ];

    
}
