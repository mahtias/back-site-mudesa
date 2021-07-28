<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ceremonie extends Model
{
    //
    protected $table = 'ceremonies';

    public $timestamps = false;

    protected $guarded = ['id'];
}
