<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'content',
        'slug',
        'category_id',
        'cover'
    ];

    public function category() {
        return $this->belongsTo('App\Category');
    }

    public function tags() {
        return $this->belongsToMany('App\Tag');

        // Se voglio aggiungere un nome arbitrario alla tabella ponte,
        // basta passare un secondo parametro:
        // return $this->belongsToMany('App\Tag', 'tag_post');
    }

    
}
