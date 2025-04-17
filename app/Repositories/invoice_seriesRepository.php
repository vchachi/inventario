<?php

namespace App\Repositories;

use App\Models\invoice_series;
use App\Repositories\BaseRepository;

/**
 * Class invoice_seriesRepository
 * @package App\Repositories
 * @version March 23, 2023, 6:58 pm UTC
*/

class invoice_seriesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre',
        'shortname',
        'tax_type',
        'default_repairs',
        'default_sells'
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
        return invoice_series::class;
    }
}
