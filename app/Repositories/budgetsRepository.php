<?php

namespace App\Repositories;

use App\Models\budgets;
use App\Repositories\BaseRepository;

/**
 * Class budgetsRepository
 * @package App\Repositories
 * @version March 18, 2023, 3:03 am UTC
*/

class budgetsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'number',
        'date',
        'state',
        'client_id',
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
        return budgets::class;
    }
}
