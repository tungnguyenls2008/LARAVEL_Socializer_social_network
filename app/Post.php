<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Image;
use Illuminate\Support\Str;

class Post extends Model
{
    protected $fillable = [
    	'body', 'user_id'
    ];

    protected $post_image_path = 'img/posts/';

    public function infoStatus(){
        return $this->likes()->count() . ' Lượt thích | '. $this->comments()->count() . ' Bình luận';
    }

    public function imagePath(Image $img){
        return $this->post_image_path . $img->filename;
    }

    /* Relations */

    public function notifications(){
        return $this->morphMany('App\notification', 'notification');
    }

    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function likes(){
        return $this->morphMany('App\Like', 'likeable');
    }

    public function comments(){
        return $this->hasMany('App\Comment');
    }

    public function saves(){
        return $this->hasMany('App\Save');
    }

    public function tags(){
        return $this->hasMany('App\Tag');
    }

    public function images(){
        return $this->morphMany('App\Image', 'imageable');
    }

}
