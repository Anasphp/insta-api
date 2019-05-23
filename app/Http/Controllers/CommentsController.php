<?php
namespace App\Http\Controllers;
use App\Comment;
use App\Replycomment;
use Illuminate\Http\Request;
class CommentsController extends Controller
{
  /**
   * Comment a post
   * @method commentPost
   * @param  Request $request Request class
   * @return string JSON containing commented post id and success value
   */
  public function commentPost( Request $request )
  {
    $comment= new Comment;
    $comment->user_id=$request->input('user_id');
    $comment->user_posts_id=$request->input('post_id');
    $comment->user_comments=$request->input('comment');
    $comment->save();
    return response()->json(array(
      'error' => false,
      'message'   =>  'Comments added to the post',
      'data'   =>  $comment,
      'code'      =>  201,
    ), 201);
  }
  /**
   * Update a comment
   * @method commentUpdate
   * @param  Request $request Request class
   * @return string JSON containing commented post id and success value
   */
  public function commentUpdate( Request $request )
  {
    $comment=  Comment::find($request->input('comments_id'));
    if($comment) {
      $comment->user_comments = $request->input('user_comments');
      $comment->save();
      return response()->json(array(
        'error' => false,
        'message'   =>  'Comments Edited Successfully',
        'data'   =>  $comment,
        'code'      =>  201,
      ), 201);
    } else {
      return response()->json(array(
        'error' => true,
        'message'   =>  'Comment cannot be Edited',
        'data'   =>  $comment,
        'code'      =>  201,
      ), 201);
    }
  }
  /**
   * Delete a comment
   * @method commentDelete
   * @param  Request $request Request class
   * @return string JSON containing commented post id and success value
   */
  public function commentDelete($id)
  {
    $comment = Comment::find( $id );
    if($comment) {
      $comment->delete();
      $reply = Replycomment::where('comment_id',$id)->delete();
      return response()->json(array(
        'error' => false,
        'message'   => 'Comment deleted successfully!',
        'data'   =>  $comment,
        'code'      =>  201,
      ), 201);
    } else {
      return response()->json(array(
        'error' => true,
        'message'   =>  'Comment cannot be deleted',
        'data'   =>  $comment,
        'code'      =>  201,
      ), 201);
    }
  }

  public function replyComments( Request $request )
  {
    $reply = new Replycomment;
    $reply->user_id=$request->input('user_id');
    $reply->post_id=$request->input('post_id');
    $reply->comment_id=$request->input('comment_id');
    $reply->reply_text=$request->input('reply_text');
    $reply->save();
    return response()->json(array(
      'error' => false,
      'message'   =>  'Reply added Successfully',
      'data'   =>  $reply,
      'code'      =>  201,
    ), 201);
  }
}
