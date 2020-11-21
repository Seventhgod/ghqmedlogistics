<?php

namespace App\Repositories;

use App\Models\DrugRequest;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class DrugRequestRepository
 * @package App\Repositories
 * @version September 4, 2020, 9:57 am UTC
 *
 * @method DrugRequest findWithoutFail($id, $columns = ['*'])
 * @method DrugRequest find($id, $columns = ['*'])
 * @method DrugRequest first($columns = ['*'])
*/
class DrugRequestRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return DrugRequest::class;
    }
}
