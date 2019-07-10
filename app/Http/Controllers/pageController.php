<?php

namespace Lucid\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class pageController extends Controller
{
    public function homePage($username)
    {
            $directory = storage_path($username.'/contents');
            $ziki = new \Lucid\Core\Document($directory);
            $feed = $ziki->fetchRss();
            
        return view('home', ['posts' => $feed]);

    }

    public function singlePostPage($username,$postTitle){
        $user_exists = DB::table('users')->where('name',$username)->orWhere('username',$username)->get();
        if(!isset($user_exists[0])) {
            return '=====404======';
        }
        $directory = storage_path('/'.$username.'/contents/');
        $app  = new \Lucid\Core\Document($directory);
        $post=$app->getPost($postTitle);
        
        if(!$post){
            return redirect('/'.$username.'/home');
        }
         return view('single-blog-post',compact('post'));
    }
}