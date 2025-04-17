<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class companies
 * @package App\Models
 * @version March 23, 2023, 8:48 pm UTC
 *
 * @property string $socialname
 * @property string $CIFNIF
 * @property string $address
 * @property string $localidad
 * @property string $provincia
 * @property string $postal_code
 * @property string $country
 * @property string $phone
 * @property string $website
 * @property string $email
 * @property string $logo
 */
class companies extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'companies';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'socialname',
        'CIFNIF',
        'address',
        'localidad',
        'provincia',
        'postal_code',
        'country',
        'phone',
        'website',
        'email',
        'logo',
        'id_user_master'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'socialname' => 'string',
        'CIFNIF' => 'string',
        'address' => 'string',
        'localidad' => 'string',
        'provincia' => 'string',
        'postal_code' => 'string',
        'country' => 'string',
        'phone' => 'string',
        'website' => 'string',
        'email' => 'string',
        'logo' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'socialname' => 'required',
        'CIFNIF' => 'required',
        'address' => 'required',
        'localidad' => 'required',
        'provincia' => 'required',
        'postal_code' => 'required',
        'country' => 'required',
        'phone' => 'required',
        'email' => 'email',
        'logo' => 'required'
    ];

    
}
