<?php 

namespace App\Http\Controllers;

use App\User;
use App\Comment;
use App\UserPosts;
use Illuminate\Http\Request;
use Illuminate\Hashing\BcryptHasher;
// use Illuminate\Http\Session;

use Session;

class AdminUserController extends Controller
{
	public function listAllUsers()
    {
		$users = User::where('category',0)->where('is_active',1)->with('posts')->get();
		return response()->json(array(
	    			'error' => false,
	                'message'   =>  'All Users Listed',
	                'data'   =>  $users,
	                'code'      =>  201,
	            ), 201);
    }

    public function editUser(Request $request)
    {
		$editUser = User::find($request->id);
		$editUser->name = $request->name;
		$editUser->update();
		return response()->json(array(
	    			'error' => false,
	                'message'   =>  'User Edited Successfully',
	                'data'   =>  $editUser,
	                'code'      =>  201,
	            ), 201);
    }

    public function deleteUser(Request $request)
    {
		$deleteUser = User::find($request->id);
		$deleteUser->is_active = 0;
		if($deleteUser->update()) {
			$deletePost = UserPosts::where('user_id',$request->id)->get();
			foreach ($deletePost as $data) {
				$data->delete();
			}
		}
		return response()->json(array(
	    			'error' => false,
	                'message'   =>  'User Deleted Successfully',
	                'data'   =>  $deleteUser,
	                'code'      =>  201,
	            ), 201);
    }

    public function createUser(Request $request)
    {
    	$response = $request->all();
    	$findExisting = User::where('email', '=', $response['email'])->get();
    	if(count($findExisting) === 0) {
    		$user = new User;
	        $user->name = $response['name'];
	        $user->email = $response['email'];
	        $user->password = (new BcryptHasher)->make($response['password']);
	        $user->save();
    	} else {
    		return response()->json(array(
    				'error' => true,
                    'message'   =>  'Email Already Exists',
                    'data'   =>  '',
                    'code'      =>  409,
                ), 201);
    	}
        return response()->json(array(
        			'error' => false,
                    'message'   =>  'Registered Successfully',
                    'data'   =>  $user,
                    'code'      =>  201,
                ), 201);
    }


    public function listAllPosts()
    {
		$listAllPosts = UserPosts::where('is_active', 1)->with('comments')->with('user')->latest()->get();
		return response()->json(array(
	    			'error' => false,
	                'message'   =>  'All Posts Listed',
	                'data'   =>  $listAllPosts,
	                'code'      =>  201,
	            ), 201);
    }

    public function postDetails(Request $request, $post_id)
    {
	 $postDetails = UserPosts::where('user_posts_id', $post_id)->with('user','adminComments.user','adminComments.replies.user')->get();
        return response()->json(array(
                    'error' => false,
                    'message'   =>  'Post Details Listed',
                    'data'   =>  $postDetails,
                    'code'      =>  201,
                ), 201);
    }

    public function disableComments(Request $request, $id)
    {
		$disableComments = Comment::find($request->id);
		$disableComments->comment_status = 0;
		$disableComments->update();
		return response()->json(array(
	    			'error' => false,
	                'message'   =>  'Comment Disabled Successfully',
	                'data'   =>  $disableComments,
	                'code'      =>  201,
	    ), 201);
    }

    public function enableComments(Request $request, $id)
    {
		$enableComments = Comment::find($request->id);
		$enableComments->comment_status = 1;
		$enableComments->update();
		return response()->json(array(
	    			'error' => false,
	                'message'   =>  'Comment Enabled Successfully',
	                'data'   =>  $enableComments,
	                'code'      =>  201,
	    ), 201);
    }

    public function disableAllComments(Request $request, $id)
    {
		$disableAllComments = Comment::where('user_posts_id',$request->id)->get();
		foreach ($disableAllComments as $value) {
			$value->comment_status = 0;
			$value->update();
		}
		return response()->json(array(
	    			'error' => false,
	                'message'   =>  'All Comments Disabled',
	                'data'   =>  $disableAllComments,
	                'code'      =>  201,
	    ), 201);
    }

    public function enableAllComments(Request $request, $id)
    {
		$enableAllComments = Comment::where('user_posts_id',$request->id)->get();
		foreach ($enableAllComments as $value) {
			$value->comment_status = 1;
			$value->update();
		}
		return response()->json(array(
	    			'error' => false,
	                'message'   =>  'All Comments Enabled',
	                'data'   =>  $enableAllComments,
	                'code'      =>  201,
	    ), 201);
    }
}