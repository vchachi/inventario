<?php

namespace App\Repositories;

use App\Models\access_levels;
use App\Repositories\BaseRepository;

/**
 * Class access_levelsRepository
 * @package App\Repositories
 * @version March 23, 2023, 10:33 pm UTC
*/

class access_levelsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'pin',
        'permisions_json'
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
        return access_levels::class;
    }
}
