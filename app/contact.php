<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class contact extends Model
{
    //
    protected $table = 'contacts';

    public $timestamps = false;

    protected $guarded = ['id'];
}
