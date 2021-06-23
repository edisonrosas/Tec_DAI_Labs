<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Comment;
use App\Models\User;
use App\Notifications\CommentsPost;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Notification;


class CommentController extends Controller
{
    use Notifiable; 
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $request->validate([
            'content'=> 'required:max:250',
        ]);

        $comment = new Comment();
        $comment->user_id=$request->user()->id;
        $comment->content=$request->get('content');

        $post = Post::find($request->get('post_id'));
        
        $user= User::find($post->user->id);
        $user->notify(new CommentsPost($post,$comment));


        //Notification::send($user,new CommentsPost());
      
        $post->comments()->save($comment);

        
        //Notification::send($user,new CommentsPost());

        return redirect()->route('post',['id'=> $request->get('post_id')]);
    }

    public function notificaciones(Request $request)
    {
        $user=$request->user();
        $notificaciones= $user->unreadNotifications;
        return view('/notificaciones',compact('notificaciones'));
    }
}
