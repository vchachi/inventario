<?php

namespace App\Repositories;

use App\Models\invoice_custom;
use App\Repositories\BaseRepository;

/**
 * Class invoice_customRepository
 * @package App\Repositories
 * @version March 23, 2023, 8:27 pm UTC
*/

class invoice_customRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'text'
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
        return invoice_custom::class;
    }
}
