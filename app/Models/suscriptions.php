<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class suscriptions
 * @package App\Models
 * @version March 23, 2023, 10:19 pm UTC
 *
 * @property string $title
 * @property integer $frequency
 * @property string $description
 */
class suscriptions extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'suscriptions';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'title',
        'frequency',
        'description'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'frequency' => 'integer',
        'description' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required',
        'frequency' => 'required',
        'description' => 'required'
    ];

    
}
