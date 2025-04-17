<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class repairs
 * @package App\Models
 * @version March 18, 2023, 2:49 am UTC
 *
 * @property string $client_id
 * @property integer $category_id
 * @property string $brand
 * @property string $model
 * @property string $imei_serie
 * @property number $repair_cost
 * @property string $concept
 * @property string $observations
 * @property integer $status
 * @property string $date
 */
class repairs extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'repairs';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'client_id',
        'category_id',
        'brand',
        'model',
        'imei_serie',
        'repair_cost',
        'concept',
        'observations',
        'status',
        'date',
        'id_user_master'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'client_id' => 'string',
        'category_id' => 'integer',
        'brand' => 'string',
        'model' => 'string',
        'imei_serie' => 'string',
        'repair_cost' => 'double',
        'concept' => 'string',
        'observations' => 'string',
        'status' => 'integer',
        'date' => 'datetime'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'client_id' => 'required',
        'category_id' => 'required',
        'brand' => 'required',
        'model' => 'required',
        'imei_serie' => 'required',
        'repair_cost' => 'numeric',
        'concept' => 'required',
        'observations' => 'required',
        'status' => 'required',
        'date' => 'required'
    ];

    
}
