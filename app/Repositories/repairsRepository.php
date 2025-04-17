<?php

namespace App\Repositories;

use App\Models\repairs;
use App\Repositories\BaseRepository;

/**
 * Class repairsRepository
 * @package App\Repositories
 * @version March 18, 2023, 2:49 am UTC
*/

class repairsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'client_id',
        'category_id',
        'brand',
        'model',
        'imei_serie',
        'repair_cost',
        'concept',
        'observations',
        'status',
        'date'
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
        return repairs::class;
    }
}
