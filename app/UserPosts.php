<?php

namespace App;

use Comment;

use Illuminate\Database\Eloquent\Model;

class UserPosts extends Model
{
    protected $table = 'user_posts';

    protected $primaryKey = 'user_posts_id';

    protected $fillable = [
        'user_post_description','is_active'
    ];

    public function comments()
    {
        return $this->hasMany('App\Comment', 'user_posts_id', 'user_posts_id')->where('comment_status','1');
    }

    public function adminComments()
    {
        return $this->hasMany('App\Comment', 'user_posts_id', 'user_posts_id');
    }

	public function user()
	{
	    return $this->belongsTo('App\User','user_id');
	}

}
