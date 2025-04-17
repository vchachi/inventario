<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class safeguards
 * @package App\Models
 * @version March 20, 2023, 3:37 am UTC
 *
 * @property string $title
 * @property string $text
 */
class safeguards extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'safeguards';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'title',
        'text',
        'id_user_master'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'text' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required',
        'text' => 'required'
    ];

    
}
