<?php 

namespace App\Http\Controllers;

use App\User;
use App\UserPosts;
use App\UserProfileImage;
use Illuminate\Http\Request;
use Illuminate\Hashing\BcryptHasher;
// use Illuminate\Http\Session;

use Session;

class ProfileController extends Controller
{
   public function index($id)
    {
        $profile = User::where('id',$id)->with('posts')->first();
        return response()->json(array(
            'error' => true,
            'message'   =>  'Profile Details Fetched',
            'data'   =>  $profile,
            'code'      =>  201,
        ), 201);
    }

    public function imageUpdate( Request $request ) {
       $image = $request->file('profile_image');
       $imageName = 'image-'.time().'.'.'jpg';
       $destinationPath = base_path('public/images/users');
       $image->move($destinationPath, $imageName);
       $imageUpdate = User::find($request->get('user_id'));
       $imageUpdate->image_url = $imageName;
       $imageUpdate->save();
        return response()->json(array(
            'error' => true,
            'message'   =>  'Profile Details Fetched',
            'data'   =>  $imageUpdate,
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

    public function editUser(Request $request)
    {
        $editUser = User::find($request->id);
        $editUser->name = $request->name;
        $editUser->update();
        return response()->json(array(
                    'error' => false,
                    'message'   =>  'User Name Edited Successfully',
                    'data'   =>  $editUser,
                    'code'      =>  201,
                ), 201);
    }



}