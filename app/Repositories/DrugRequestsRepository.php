<?php

namespace App\Repositories;

use App\Models\DrugRequests;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class DrugRequestsRepository
 * @package App\Repositories
 * @version September 3, 2020, 8:06 pm UTC
 *
 * @method DrugRequests findWithoutFail($id, $columns = ['*'])
 * @method DrugRequests find($id, $columns = ['*'])
 * @method DrugRequests first($columns = ['*'])
*/
class DrugRequestsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'project_name',
        'project_date',
        'initiator',
        'unit',
        'pharmacist',
        'file_number',
        'indent_number',
        'mission_code',
        'status'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return DrugRequests::class;
    }
}
