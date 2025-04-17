<?php

namespace App\Repositories;

use App\Models\parts;
use App\Repositories\BaseRepository;

/**
 * Class partsRepository
 * @package App\Repositories
 * @version March 18, 2023, 3:00 am UTC
*/

class partsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'url',
        'observations'
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
        return parts::class;
    }
}
