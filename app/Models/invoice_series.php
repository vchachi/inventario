<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class invoice_series
 * @package App\Models
 * @version March 23, 2023, 6:58 pm UTC
 *
 * @property string $nombre
 * @property string $shortname
 * @property integer $tax_type
 * @property boolean $default_repairs
 * @property boolean $default_sells
 */
class invoice_series extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'invoice_series';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'nombre',
        'shortname',
        'tax_type',
        'default_repairs',
        'default_sells'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nombre' => 'string',
        'shortname' => 'string',
        'tax_type' => 'integer',
        'default_repairs' => 'boolean',
        'default_sells' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nombre' => 'required',
        'shortname' => 'required',
        'tax_type' => 'required',
        'default_repairs' => 'required',
        'default_sells' => 'required'
    ];

    
}
