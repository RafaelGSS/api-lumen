<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Author;

class Book extends Model
{
    protected $fillable = ['name','category','description','slug', 'author_id'];



    public function author()
    {
    	return $this->belongsTo('App\Author');
    }
}