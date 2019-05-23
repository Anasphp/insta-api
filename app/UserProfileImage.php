<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProfileImage extends Model
{
    protected $table = 'user_profile_images';

    protected $primaryKey = 'user_posts_id';

    protected $fillable = [
        'user_image_url'
    ];

     // protected $hidden = ['image_url'];


}
