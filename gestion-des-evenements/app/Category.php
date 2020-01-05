<?php

namespace App;
use App\Event;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded=[];
    public function events(){
        return $this->hasMany(Event::class);
    }
    public function getRouteKeyName(){
        return 'name';
    }
}
