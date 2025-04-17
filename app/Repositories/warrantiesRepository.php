<?php

namespace App\Repositories;

use App\Models\warranties;
use App\Repositories\BaseRepository;

/**
 * Class warrantiesRepository
 * @package App\Repositories
 * @version March 20, 2023, 3:32 am UTC
*/

class warrantiesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'warraty_for',
        'duration',
        'conditions',
        'url_conditions'
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
        return warranties::class;
    }
}
