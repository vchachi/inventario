<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class budgets
 * @package App\Models
 * @version March 18, 2023, 3:03 am UTC
 *
 * @property string $number
 * @property string $date
 * @property integer $state
 * @property integer $client_id
 * @property string $observations
 */
class budgets extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'budgets';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'number',
        'date',
        'state',
        'client_id',
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
        'client_id' => 'integer',
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
        'client_id' => 'integer',
        'observations' => 'required'
    ];

    
}
