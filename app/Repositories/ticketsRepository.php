<?php

namespace App\Repositories;

use App\Models\tickets;
use App\Repositories\BaseRepository;

/**
 * Class ticketsRepository
 * @package App\Repositories
 * @version March 23, 2023, 5:21 pm UTC
*/

class ticketsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'print_method',
        'autoprint',
        'head',
        'barcode',
        'paper_size',
        'margin_top',
        'margin_right',
        'margin_bottom',
        'margin_left',
        'ticket_edit',
        'hide_address',
        'hide_nifcif',
        'hide_phone',
        'hide_email',
        'hide_website',
        'hide_barcode'
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
        return tickets::class;
    }
}
