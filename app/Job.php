<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    // default table is jobs
    protected $table = 'Jobs';
    public $timestamps = false;
}
