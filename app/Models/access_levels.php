<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class access_levels
 * @package App\Models
 * @version March 23, 2023, 10:33 pm UTC
 *
 * @property string $name
 * @property string $pin
 * @property string $permisions_json
 */
class access_levels extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'access_levels';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'pin',
        'permisions_json'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'pin' => 'string',
        'permisions_json' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'pin' => 'required',
        'permisions_json' => 'required'
    ];

    
}
