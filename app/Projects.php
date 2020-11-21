<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    public $table = 'projects';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public $fillable = [
        'project_code',
        'project_name',
        'date',
        'type',
        'initiator',
        'unit',
        'file_number',
        'mission_code',
        'status',
        'init_contact',
        'email',
        'pharmacist',
        'exchange_rate',
        'order_number',
        'reference'
    ];
}
