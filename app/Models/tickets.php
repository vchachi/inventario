<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class tickets
 * @package App\Models
 * @version March 23, 2023, 5:21 pm UTC
 *
 * @property integer $print_method
 * @property integer $autoprint
 * @property integer $head
 * @property integer $barcode
 * @property string $paper_size
 * @property string $margin_top
 * @property string $margin_right
 * @property string $margin_bottom
 * @property string $margin_left
 * @property integer $ticket_edit
 * @property boolean $hide_address
 * @property boolean $hide_nifcif
 * @property boolean $hide_phone
 * @property boolean $hide_email
 * @property boolean $hide_website
 * @property boolean $hide_barcode
 */
class tickets extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'tickets';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'print_method',
        'autoprint',
        'head',
        'barcode',
        'paper_size',
        'margin_top',
        'margin_right',
        'margin_bottom',
        'margin_left',
        'ticket_edit',
        'hide_address',
        'hide_nifcif',
        'hide_phone',
        'hide_email',
        'hide_website',
        'hide_barcode',
        'id_user_master'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'print_method' => 'integer',
        'autoprint' => 'integer',
        'head' => 'integer',
        'barcode' => 'integer',
        'paper_size' => 'string',
        'margin_top' => 'string',
        'margin_right' => 'string',
        'margin_bottom' => 'string',
        'margin_left' => 'string',
        'ticket_edit' => 'integer',
        'hide_address' => 'boolean',
        'hide_nifcif' => 'boolean',
        'hide_phone' => 'boolean',
        'hide_email' => 'boolean',
        'hide_website' => 'boolean',
        'hide_barcode' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'print_method' => 'required',
        'autoprint' => 'required',
        'head' => 'required',
        'barcode' => 'required',
        'paper_size' => 'required',
        'margin_top' => 'required',
        'margin_right' => 'required',
        'margin_bottom' => 'required',
        'margin_left' => 'required',
        'ticket_edit' => 'required',
        'hide_address' => 'required',
        'hide_nifcif' => 'required',
        'hide_phone' => 'required',
        'hide_email' => 'required',
        'hide_website' => 'required',
        'hide_barcode' => 'required'
    ];

    
}
