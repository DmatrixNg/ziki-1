<?php

namespace Lucid\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class ReactionsController extends Controller
{


  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
      $this->middleware('auth');
  }


    public function like(Request $request)
    {

  $post = DB::table('posts')->where('id', $request->id)->first();

  $user = Auth::user();
switch ($request->act){
    case "1":

    $like = DB::table('notifications')->insert([
      'post_id'=>$request->id,
      'parent_comment_id'=> null,
      'comment'=>null,
      'sender_id'=> $user['id'],
      'user_id'=>$post->user_id,
      'status'=> 0,
      'action'=>"Like",
      'type'=>"Like",
    ]);

    break;

    case "0":
    $file= DB::table('notifications')
    ->where([
      'post_id'   =>$request->id,
      'sender_id' => $user['id'],
      'action'    =>"Like",
      'type'      =>"Like"
      ])->delete();


    break;

}
$count = DB::table('notifications')->where(['post_id'=>$request->id,'action'=> "like"])->get();
$count = count($count);
$count ="<sub id='count$request->id'>$count</sub>";

$link = DB::table('notifications')->where(['post_id'=>$request->id,'sender_id'=> $user['id'], 'action'=> "like"])->exists();
//dd($link);
if ($link) {
  $output = "
<span id='like$request->id'>
<button type='button' title='unlike this Post' onclick='like(0,$request->id)' class='btn'><i class='icon ion-md-thumbs-up text-warning' style='font-size: 1.2em;'></i>
$count
</button></span>
";
}else {
    $output = "
  <span id='like$request->id'>
  <button type='button' title='like this Post' onclick='like(1,$request->id)' class='btn'><i class='icon ion-md-thumbs-up' style='font-size: 1.2em;'></i>
$count
  </button></span>
  ";

    }
    $data = array(
       'button' => $output,
       'count'  => $count
    );
    return response()->json($data);
  }
}
