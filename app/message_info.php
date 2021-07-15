<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class message_info extends Model
{
    //
    protected $table = 'message_infos';

    public $timestamps = false;

    protected $guarded = ['id'];
}
