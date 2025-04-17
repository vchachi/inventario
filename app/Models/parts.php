<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class parts
 * @package App\Models
 * @version March 18, 2023, 3:00 am UTC
 *
 * @property string $name
 * @property string $brand
 * @property string $model
 * @property integer $category_id
 * @property string $provider
 * @property string $reference
 * @property number $buy_price
 * @property number $sell_price
 * @property integer $units
 * @property integer $state
 * @property string $observations
 */
class parts extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'parts';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'url',
        'observations',
        'id_user_master',
        'active',
        'id_repara'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'url' => 'string',
        'observations' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'observations' => 'required'
    ];


}
