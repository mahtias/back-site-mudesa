<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrgSocio extends Model
{
    //
    protected $table = 'org_socios';

    public $timestamps = false;

    protected $guarded = ['id'];
}
