<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Logger extends Model
{
    protected $hidden = array('id', 'updated_at');
}
