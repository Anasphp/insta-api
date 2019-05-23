<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Replycomment extends Model
{
	protected $table = 'reply_comments';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'reply','comment_id','user_id', 'post_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
}
