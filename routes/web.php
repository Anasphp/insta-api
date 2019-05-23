<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});


$router->get('/key', function() {
    return str_random(32);
});


$router->group(
    ['middleware' => 'jwt.auth'], 
    function() use ($router) {
        $router->get('users', function() {
            $users = \App\User::all();
            return response()->json($users);
        });
    }
);

$router->group(['prefix' => 'api'], function () use ($router) {
	  $router->post('register', ['uses' => 'UserController@register']);
    $router->post('login', ['uses' => 'AuthController@authenticate']);
    $router->get('remove/{id}', ['uses' => 'AuthController@remove']);
	  // $router->post('imageUpload', ['uses' => 'ImageController@uploadImage']);
	  $router->get('getImage', ['uses' => 'ImageController@getImage']);
	  $router->get('userlists', ['uses' => 'UserController@userLists']);
	  $router->post('createPost', ['uses' => 'UserController@createPosts']);
    $router->get('listMyPosts/{id}', ['uses' => 'UserController@listMyPosts']);
    $router->get('activePost/{id}', ['uses' => 'UserController@activePost']);
	  $router->get('listAllPosts/{id}', ['uses' => 'UserController@listAllPosts']);
    $router->post('postComments', ['uses' => 'CommentsController@commentPost']);
    $router->post('editComments', ['uses' => 'CommentsController@commentUpdate']);
    $router->get('deleteComments/{comment_id}', ['uses' => 'CommentsController@commentDelete']);
    $router->get('postDetails/{post_id}', ['uses' => 'UserController@postDetails']);
    $router->get('viewAllposts', ['uses' => 'UserController@viewAllposts']);
    $router->post('replyComments', ['uses' => 'CommentsController@replyComments']);
    $router->get('profileDetails/{id}', ['uses' => 'ProfileController@index']);
    $router->post('profileImage/', ['uses' => 'ProfileController@imageUpdate']);
    $router->post('editUser', ['uses' => 'ProfileController@editUser']);
});

$router->group(['prefix' => 'admin/api'], function () use ($router) {
    //Users API
    $router->post('userupdate/{id}', ['uses' => 'AuthController@userUpdate']);
    $router->get('userdetails/{id}', ['uses' => 'UserController@userDetails']);
    //Posts API
    $router->get('listAllPosts', ['uses' => 'AdminUserController@listAllPosts']);
    $router->get('postDetails/{id}', ['uses' => 'AdminUserController@postDetails']);
    $router->get('listAllUsers', ['uses' => 'AdminUserController@listAllUsers']);
    $router->post('editUser', ['uses' => 'AdminUserController@editUser']);
    $router->post('deleteUser', ['uses' => 'AdminUserController@deleteUser']);
    $router->post('createUser', ['uses' => 'AdminUserController@createUser']);
    $router->get('disableComments/{id}', ['uses' => 'AdminUserController@disableComments']);
    $router->get('enableComments/{id}', ['uses' => 'AdminUserController@enableComments']);
    $router->get('enableAllComments/{id}', ['uses' => 'AdminUserController@enableAllComments']);
    $router->get('disableAllComments/{id}', ['uses' => 'AdminUserController@disableAllComments']);    
});