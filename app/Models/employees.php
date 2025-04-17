<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class employees
 * @package App\Models
 * @version March 20, 2023, 3:50 am UTC
 *
 * @property string $name
 * @property string $lastname
 * @property integer $position
 */
class employees extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'employees';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'lastname',
        'position'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'lastname' => 'string',
        'position' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'lastname' => 'required',
        'position' => 'required'
    ];

    
}
