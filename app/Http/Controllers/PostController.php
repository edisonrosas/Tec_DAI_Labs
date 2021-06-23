<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
class PostController extends Controller
{
    public function __construc()
    {
        $this->middleware('Auth')->except(['index','show']);
    }

    public function index()
    {
        $posts=Post::paginate(10);
        return view('posts.index',compact('posts'));     
    }
    public function show($id)
    {
        $resultado=Post::find($id);
        //return view('postUnico', ['post' => $resultado]);
        return view('posts.postUnico',['post'=> $resultado]);
    }
    public function create (Request $request)
    {
        return view('posts.create');
        
        /*
        $request->validate([
            'title'=>'required:max:120',
            'image'=>'required|image|mimes:jpeg,png,jpg|max:2080',
            'content'=>'required:max:2020',
        ]);
        $image=$request->file('image');
        $imageName=time().$image->getClientOriginalName();
        $title=$request->get('title');
        $content=$request->get('content');
        
        $post=new Post();
        $post->title = $title;
        $post->image = 'img/' .$imageName;
        $post->content = $content;
        $post->save();
        
        $request->image->move(public_path('img'),$imageName);
        return redirect()->route('post',['id'=>$post->id]);
        */
    }
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required:max:120',
            'image'=>'required|image|mimes:jpeg,png,jpg|max:2080',
            'content'=>'required:max:2020',
        ]);
      #  $image=$request->file('image');
      #  $imageName=time().$image->getClientOriginalName();
        $imageName= $request->file('image')->store(
            'posts'.Auth::id(),
            'public'
        );
        $title=$request->get('title');
        $content=$request->get('content');        
        $post = $request->user()->posts()->create([
            'title'=>$title,
        //  'image' => 'img/' .$imageName,
            'image' => $imageName,
            'content' => $content,
        ]);
     //   $request->image->move(public_path('img'),$imageName);
        return redirect()->route('post',['id'=>$post->id]);
    }

    public function deletePost(Request $request)
    {    
        $post = Post::find($request->get('post_id'));
        $post->delete();
        $posts=Post::paginate(10);
        return view('posts.index',compact('posts'));
    }

    public function userPosts(){
        //Se encuentra al usuario y se muestran los posts de este usuario
        $user_id=Auth::id();
        $posts=Post::where('user_id','=',$user_id)->get();
        return view('posts.index',compact('posts'));
    }

    public function todaylist()
    {
      //  $posts=Post::where('created_at', '>=', date('Y-m-d').' 00:00:00');
   //   $posts=Post::whereDay('created_at', now()->day)->get();
 //     $posts=Post::whereDate('created_at', Carbon::today())->get();
 //     $posts=Post::whereDate('created_at', Carbon::now()->format('m/d/Y'))->get();


      $dt = Carbon::now()->startOfDay();   //Obtiene el dia actual usando Carbon

      //Crea una consulta en la que se muestran los datos creados despues del inicio del día
      $posts = Post::where('created_at', '>',$dt)->get(); 
      //Mongodb/eloquent no soporta WhereDay/WhereDate

      //Retorna la vista today, retornando los datos de $posts
        return view('today',compact('posts'));
    }
}
