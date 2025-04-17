<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class invoice_custom
 * @package App\Models
 * @version March 23, 2023, 8:27 pm UTC
 *
 * @property string $text
 */
class invoice_custom extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'invoice_customs';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'text'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'text' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'text' => 'required'
    ];

    
}
