<?php
namespace App\Http\Controllers;
use Validator;
use App\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Firebase\JWT\ExpiredException;
use Illuminate\Support\Facades\Hash;
use Laravel\Lumen\Routing\Controller as BaseController;
class AuthController extends BaseController 
{
    /**
     * The request instance.
     *
     * @var \Illuminate\Http\Request
     */
    private $request;
    /**
     * Create a new controller instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    public function __construct(Request $request) {
        $this->request = $request;
    }
    /**
     * Create a new token.
     * 
     * @param  \App\User   $user
     * @return string
     */
    protected function jwt(User $user) {
        $payload = [
            'iss' => "lumen-jwt", // Issuer of the token
            'sub' => $user->id, // Subject of the token
            'iat' => time(), // Time when JWT was issued. 
            'exp' => time() + 60*60 // Expiration time
        ];
        
        // As you can see we are passing `JWT_SECRET` as the second parameter that will 
        // be used to decode the token in the future.
        return JWT::encode($payload, env('JWT_SECRET'));
    } 
    /**
     * Authenticate a user and return the token if the provided credentials are correct.
     * 
     * @param  \App\User   $user 
     * @return mixed
     */
    public function authenticate(User $user) {
        $this->validate($this->request, [
            'email'     => 'required|email',
            'password'  => 'required'
        ]);
        // Find the user by email
        $user = User::where('email', $this->request->input('email'))->first();
        if (!$user) {
            // You wil probably have some sort of helpers or whatever
            // to make sure that you have the same response format for
            // differents kind of responses. But let's return the 
            // below respose for now.
            return response()->json([
                'error' => true,
                'message' => 'Failed to Log in',
                'data' => '',
                'code' => 202,
                'token' => ''
            ], 202);
        }
        // Verify the password and generate the token
        if (Hash::check($this->request->input('password'), $user->password)) {
                // session(['id' => $user['id']]);
                // session(['name' => $user['name']]);
            return response()->json([
                'error' => false,
                'message' => 'Successfully Logged In',
                'data' => $user,
                'code' => 202,
                'token' => $this->jwt($user)
            ], 202);
        }
        // Bad Request response
        return response()->json([
            'error' => true,
            'message' => 'Credentials Does Not Match',
            'data' => '',
            'code' => 202,
            'token' => ''
        ], 202);
    }
    /**
     * Delete a comment
     * @method commentDelete
     * @param  Request $request Request class
     * @return string JSON containing commented post id and success value
     */
    public function remove($id)
    {
          $user = User::find( $id );
          if( !$user ) {
            return response()->json([
                'error' => true,
                'message' => 'No user found',
                'data' => '',
                'code' => 202,
                'token' => ''
            ], 202);
          } else {
            $user->delete();
            return response()->json([
                'error' => true,
                'message' => 'User deleted successfully',
                'data' => '',
                'code' => 202,
                'token' => ''
            ], 202);
          }
    }
  /**
   * Update a user
   * @method userUpdate
   * @param  Request $request Request class
   * @return string JSON containing commented post id and success value
   */
  public function userUpdate( Request $request,$id )
  {
    $this->validate($this->request, [
            'email'     => 'required|email|unique:users',
            'name'  => 'required'
        ]);
       $user=  User::find($id);
       if( !$user ) {
        return response()->json([
            'error' => false,
            'message' => 'USer not found',
            'data' => '',
            'code' => 202,
            'token' => ''
        ], 202);
       }else{
       $user->name=$request->input('name');
       $user->email=$request->input('email');
       $user->save();
       return response()->json([
        'error' => false,
        'message' => 'User details updated successfully',
        'data' => $user,
        'code' => 202,
        'token' => ''
    ], 202);
       }
    
    return response($res);
  }    
}
