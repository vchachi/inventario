<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class sales
 * @package App\Models
 * @version March 18, 2023, 2:58 am UTC
 *
 * @property string $client_id
 * @property string $product_service
 * @property number $price
 * @property integer $units
 * @property string $date
 */
class sales extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'sales';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'client_id',
        'date',
        'total',
        'subtotal',
        'iva',
        'id_repara',
        'forma_pago',
        'id_user_master',
        'user_created'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'client_id' => 'integer',
        'date' => 'datetime',
        'total' => 'double',
        'subtotal' => 'double',
        'iva' => 'double',
        'id_repara' => 'integer',
        'forma_pago'=>'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'client_id' => 'required',
        'date' => 'required',
        'total' => 'required',
        'subtotal' => 'required',
        'iva' => 'required',
        'forma_pago' => 'required'
    ];

    
}
