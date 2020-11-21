<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    public $table = 'itemList';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public $fillable = [

    ];
}
