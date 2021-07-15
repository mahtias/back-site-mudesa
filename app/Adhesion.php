<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adhesion extends Model
{
    //
    protected $table = 'adhesions';

    public $timestamps = false;

    protected $guarded = ['id'];
}

