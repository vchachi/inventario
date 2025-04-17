<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class clients
 * @package App\Models
 * @version March 18, 2023, 2:59 am UTC
 *
 * @property string $fullname
 * @property string $phone
 * @property string $NIF
 * @property string $address
 * @property string $localidad
 * @property string $provincia
 * @property string $postal_code
 * @property string $email
 * @property string $observations
 */
class clients extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'clients';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'fullname',
        'phone',
        'NIF',
        'address',
        'localidad',
        'provincia',
        'postal_code',
        'email',
        'observations',
        'id_user_master'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'fullname' => 'string',
        'phone' => 'string',
        'NIF' => 'string',
        'address' => 'string',
        'localidad' => 'string',
        'provincia' => 'string',
        'postal_code' => 'string',
        'email' => 'string',
        'observations' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'fullname' => 'required',
        'phone' => 'required',
        'localidad' => 'required',
        'provincia' => 'required',
        'postal_code' => 'required'
    ];

    
}
