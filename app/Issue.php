<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    protected $table = "issues";
    public $timestamps = true;

    protected $fillable = [
        'name', 'location', 'picture', 'state'
    ];

    public function getPhoto(){
      return Storage::get('/pictures'.'/'.$this->picture.'.png');
    }
}
