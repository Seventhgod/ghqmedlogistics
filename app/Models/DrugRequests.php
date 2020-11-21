<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DrugRequests extends Model
{
    public $table ='drugrequests';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public $fillable =[
        'projectName', 'project_code', 'ItemName', 'quantity', 'unit', 'Category'
    ];
}
