<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoricRate extends Model
{
    protected $primaryKey = 'time';
    
    public $timestamps = false;
}
