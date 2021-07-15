<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class fichier_joint extends Model
{
    //
    protected $table = 'fichier_joints';

    public $timestamps = false;

    protected $guarded = ['id'];
}
