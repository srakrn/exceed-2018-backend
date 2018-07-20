<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Logger extends Model
{
    protected $hidden = array('key_1', 'updated_at');
}
