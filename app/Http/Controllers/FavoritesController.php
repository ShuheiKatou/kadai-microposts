<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    
    //お気に入り登録
    public function store($postId){
        
        \Auth::user()->fav($postId);
        
        return back();
    }
    //お気に入り解除
    public function destroy($postId){
        
        \Auth::user()->unfav($postId);
        return back();
    }
    
    
}
