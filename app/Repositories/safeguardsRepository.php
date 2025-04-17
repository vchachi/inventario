<?php

namespace App\Repositories;

use App\Models\safeguards;
use App\Repositories\BaseRepository;

/**
 * Class safeguardsRepository
 * @package App\Repositories
 * @version March 20, 2023, 3:37 am UTC
*/

class safeguardsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
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
        return safeguards::class;
    }
}
