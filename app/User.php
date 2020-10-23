<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function microposts()
    {
        return $this->hasMany(Micropost::class);
    }
    
    public function loadRelationshipCounts()
    {
        $this->loadCount('Microposts','followings','followers','favorites');
    }
    
    public function followings(){
        return $this->belongsToMany(User::class, 'user_follow','user_id','follow_id')->withTimeStamps();
    }
    
    public function followers(){
        return $this->belongsToMany(User::class,'user_follow','follow_id','user_id')->withTimeStamps();
    }
    
    
    
    public function follow($userId){
        
        $exist = $this->is_following($userId);
        
        $its_me = $this->id == $userId;
        
        if($exist || $its_me){
            return false;
        }else{
            $this->followings()->attach($userId);
            return true;
        }
        
    }
    public function unfollow($userId){
        $exist = $this->is_following($userId);
        
        $its_me = $this->id == $userId;
        
        if($exist && !$its_me){
            $this->followings()->detach($userId);
            return true;
        }else{
            return false;
        }
    }
    
    public function is_following($userId){
        return $this->followings()->where('follow_id',$userId)->exists();
    }
    
    public function feed_microposts(){
        $userIds = $this->followings()->pluck('users.id')->toArray();
        
        $userIds[] = $this->id;
        
        return Micropost::whereIn('user_id',$userIds);
    }
    
    public function favorites(){
        return $this->belongsToMany(Micropost::class,'user_favorite','user_id','favorite_id')->withTimeStamps();
    }
    
    public function fav($userId){
        $exist = $this->is_favorite($userId);
        
        if($exist){
            return false;
        }else{
            $this->favorites()->attach($userId);
            return True;
        }
    }
    public function unfav($userId){
        $exist = $this->is_favorite($userId);
        
        if($exist){
            $this->favorites()->detach($userId);
            return true;
        }else{
            return false;
        }
    }
    public function is_favorite($postsId){
        return $this->favorites()->where('favorite_id',$postsId)->exists();
    }
    
    public function feed_favs(){
        
        $favIds = $this->favorites()->pluck('favorite_id')->toArray();
        
    }
}
