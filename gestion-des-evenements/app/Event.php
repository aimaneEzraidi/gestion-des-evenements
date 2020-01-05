<?php

namespace App;
use App\User;
use App\Category;
use App\Comment;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $guarded=[];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function comments(){
        return $this->hasMany(Comment::class)->orderBy('created_at','DESC');
    }
    public function getRouteKeyName(){
        return 'title';
    }
    public function scopeLatest($query){
        return $query->orderBy('created_at','DESC');
    }
}
