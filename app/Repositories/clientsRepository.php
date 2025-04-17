<?php

namespace App\Repositories;

use App\Models\clients;
use App\Repositories\BaseRepository;

/**
 * Class clientsRepository
 * @package App\Repositories
 * @version March 18, 2023, 2:59 am UTC
*/

class clientsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'fullname',
        'phone',
        'NIF',
        'address',
        'localidad',
        'provincia',
        'postal_code',
        'email',
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
        return clients::class;
    }
}
