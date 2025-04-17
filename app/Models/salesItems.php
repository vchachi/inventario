<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class salesItems extends Model
{
    use HasFactory;
    
    public $table = 'salesitems';



    public $fillable = [
        'id_sale',
        'reng_id',
        'id_product',
        'price',
        'amount',
        'subtotal'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id_sale' => 'integer',
        'reng_id' => 'integer',
        'id_product' => 'integer',
        'price' => 'double',
        'amount' => 'integer',
        'subtotal' => 'double'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
}
