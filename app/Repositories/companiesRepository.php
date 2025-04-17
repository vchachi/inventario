<?php

namespace App\Repositories;

use App\Models\companies;
use App\Repositories\BaseRepository;

/**
 * Class companiesRepository
 * @package App\Repositories
 * @version March 23, 2023, 8:48 pm UTC
*/

class companiesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
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
        'logo'
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
        return companies::class;
    }
}
