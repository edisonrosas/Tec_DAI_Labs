<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth; 

class UserController extends Controller
{
    public function editeProfile(Request $request)
    {
        //Se validan los datos ingresados
        $request->validate([
            'name'=>'required:max:120',
            'email'=>'required:max:120',
        ]);
        
        //Se encuentra al usuario con el id indicado
        $user = User::find($request->get('user_id'));
        
        $user->update([ //Se modifican los datos
            'name'=>$request->input('name'),
            'email'=>$request->input('email')    
        ]);
        return redirect('/posts');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'oldpassword'=>'required',
            'password'=>'required:min:8',
            'password_confirmation'=>'required|same:password', //Este dato debe ser igual a password
        ]);
        
        //Si al hashear la contraseña ingresada es igual a la almacenada en la DB
        if ( Hash::check($request->get('oldpassword'), Auth::user()->password) ){
            $user = User::find($request->get('user_id'));
            $user->update([
                //Se sube el Hash de la nueva contraseña.
                'password'=>Hash::make($request->input('password')),  
            ]);
            return redirect('/posts');
        } 
        else{
            return redirect('/editprofile');
        }
    }

    public function deleteAccount(Request $request)
    {
        //Se buscan todos los posts que posee el user_id
        $posts=Post::where('user_id','=',$request->get('user_id'));
        $posts->delete(); //Se borran todos los post
        //Se encuentra al usuario según su id y se borra
        $user = User::find($request->get('user_id'));
        $user->delete();
        //Se cargan los posts
        $posts=Post::all();
        return view('posts.index',compact('posts'));
    }
}
