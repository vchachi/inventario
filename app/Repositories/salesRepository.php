<?php

namespace App\Repositories;

use App\Models\sales;
use App\Repositories\BaseRepository;

/**
 * Class salesRepository
 * @package App\Repositories
 * @version March 18, 2023, 2:58 am UTC
*/

class salesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'client_id',
        'date',
        'total',
        'subtotal',
        'iva',
        'id_repara',
        'forma_pago'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return sales::class;
    }
}
