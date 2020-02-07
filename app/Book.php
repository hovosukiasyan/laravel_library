<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Book extends Model
{
    protected $fillable = [ 'title','year', 'author'];

    public function user(){

        return $this->belongsToMany('App\User', 'reservation', 'book_id', 'user_id');

    }
}
