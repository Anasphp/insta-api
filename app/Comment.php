<?php

namespace App;

use UserPosts;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

	protected $table = 'comments';

	    protected $primaryKey = 'comments_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'post_id','comment'
    ];

    public function posts()
    {
        return $this->belongsTo(UserPosts::class);
    }
    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public function replies()
    {
        return $this->hasMany('App\Replycomment', 'comment_id', 'comments_id');
    }

}
