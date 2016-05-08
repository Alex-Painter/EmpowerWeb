<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    protected $table = "issues";
    public $timestamps = true;

    protected $fillable = [
        'location', 'state', 'lat', 'long', 'regID', 'title', 'category'
    ];
}
