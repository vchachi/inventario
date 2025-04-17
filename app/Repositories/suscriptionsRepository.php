<?php

namespace App\Repositories;

use App\Models\suscriptions;
use App\Repositories\BaseRepository;

/**
 * Class suscriptionsRepository
 * @package App\Repositories
 * @version March 23, 2023, 10:19 pm UTC
*/

class suscriptionsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'frequency',
        'description'
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
        return suscriptions::class;
    }
}
