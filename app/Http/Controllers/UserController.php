<?php 

namespace App\Http\Controllers;

use App\User;
use App\UserPosts;
use Illuminate\Http\Request;
use Illuminate\Hashing\BcryptHasher;
// use Illuminate\Http\Session;

use Session;

class UserController extends Controller
{
   public function register(Request $request)
    {
    	$response = $request->all();
    	$findExisting = User::where('email', '=', $response['email'])->get();
    	if(count($findExisting) === 0) {
    		$user = new User;
	        $user->name = $response['name'];
	        $user->email = $response['email'];
            $user->image_url = '';
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
                    'message'   =>  'Registration Completed',
                    'data'   =>  $user,
                    'code'      =>  201,
                ), 201);
    }

    public function userLists(){
    	$userLists = User::all();
        return response()->json(array(
			'error' => false,
            'message'   =>  'User Listed Successfully',
            'data'   =>  $userLists,
            'code'      =>  201,
        ), 201);
    }

    public function userDetails($id){
        $userLists = User::where('id',$id)->get();
        if (!$userLists) {
            return response()->json([
                'error' => true,
                'message' => 'User not found',
                'data' => '',
                'code' => 202,
                'token' => ''
            ], 202);
        }
        return response()->json(array(
			'error' => false,
            'message'   =>  'User Details fetched',
            'data'   =>  $userLists,
            'code'      =>  201,
        ), 201);
    }

    public function createPosts(Request $request)
    {
       $image = $request->file('file_name');
       $imageName = 'image-'.time().'.'.'jpg';
       $destinationPath = base_path('public/images');
       $image->move($destinationPath, $imageName);
       $createPosts = new UserPosts;
       $createPosts->user_id = $request->get('userId');
       $createPosts->user_post_description = $request->get('description');
       $createPosts->user_post_image = $imageName;
       $createPosts->user_post_title = $request->get('title');
       $createPosts->save();
       return response()->json(array(
        			'error' => false,
                    'message'   =>  'Post Created Successfully',
                    'data'   =>  $createPosts,
                    'code'      =>  201,
                ), 201);
    }

    public function listMyPosts(Request $request, $id)
    {
        $listMyPosts = UserPosts::where('user_id', $id)->with('comments')->with('user')->get();
		return response()->json(array(
	    			'error' => false,
	                'message'   =>  'My Posts Listed',
	                'data'   =>  $listMyPosts,
	                'code'      =>  201,
	            ), 201);
    }

    public function postDetails(Request $request, $post_id)
    {
        $postDetails = UserPosts::where('user_posts_id', $post_id)->with('user','comments.user','comments.replies.user')->get();
        return response()->json(array(
                    'error' => false,
                    'message'   =>  'Post Details Listed',
                    'data'   =>  $postDetails,
                    'code'      =>  201,
                ), 201);
    }
    public function activePost($id)
    {
        $users = UserPosts::where('user_posts_id', $id)->first();
        if($users){
            if($users->is_active == 1){
                $users->is_active =0;
                $users=UserPosts::where('user_posts_id', $id)->update(array('is_active' => 0));
                return response()->json(array(
                    'error' => false,
                    'message'   =>  'Disabled the post successfully',
                    'data'   =>  $users,
                    'code'      =>  201,
                ), 201);
            }else{
                $users=UserPosts::where('user_posts_id', $id)->update(array('is_active' => 1));
                return response()->json(array(
                    'error' => false,
                    'message'   =>  'Enabled the post successfully',
                    'data'   =>  $users,
                    'code'      =>  201,
                ), 201);
            }
        }else{

		    return response()->json(array(
	        			'error' => false,
	                    'message'   =>  'Post not found',
	                    'data'   =>  $users,
	                    'code'      =>  201,
	                ), 201);
            // print_r($users);
                }
        }

    public function listAllPosts($id)
    {
		$users = UserPosts::where('is_active', 1)->with('comments')->with('user')->latest()->get();
		return response()->json(array(
	    			'error' => false,
	                'message'   =>  'All Posts Listed',
	                'data'   =>  $users,
	                'code'      =>  201,
	            ), 201);
    }


}