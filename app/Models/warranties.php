<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class warranties
 * @package App\Models
 * @version March 20, 2023, 3:32 am UTC
 *
 * @property string $name
 * @property integer $warraty_for
 * @property integer $duration
 * @property integer $conditions
 * @property string $url_conditions
 */
class warranties extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'warranties';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'warraty_for',
        'duration',
        'conditions',
        'url_conditions',
        'id_user_master'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'warraty_for' => 'integer',
        'duration' => 'integer',
        'conditions' => 'integer',
        'url_conditions' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'warraty_for' => 'required',
        'duration' => 'required|numeric',
        'conditions' => 'required',
        'url_conditions' => 'required'
    ];

    
}
