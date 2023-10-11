<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = [
        'user_id',
        'post_id',
        'type_id',
        'title',
        'body',
        'picture',
        'anonymity',
        'unsolved',
        ];
    
    public function childposts()
    {
        return $this->hasMany(Post::class)->withTrashed();
    }
    
    
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function parentpost()
    {
        return $this->belongsTo(Post::class);
    }
    
    public function types()
    {
        return $this->belongsTo(Type::class);
    }
    
    public function likes()
    {
        return $this->hasMany(Like::class, 'post_id');
    }
    
    
    public function getTimeDifferenceAttribute()//現在時刻との差を取得
    {
        $now = Carbon::now();
        $createdAt = $this->created_at;

        return $createdAt->diffForHumans($now);
    }
    
    public function getReply()
    {
        $depth = 5; //取得するコメントの数を制限
        return $this->recursiveAllChildPosts($depth);
        
    }
    
    public function recursiveAllChildPosts($depth) //返信を再帰的に取得
    {
        $childPosts = $this->childPosts;
        $childPosts_sorted = $this->sortChildPosts($childPosts);
        if ($depth > 1 &&  $childPosts) {
            foreach ($childPosts_sorted as $childPost) {
                $childPost->childPosts = $childPost->recursiveAllChildPosts($depth - 1);
            }
        }
        return $childPosts_sorted;
    }
    
    public function sortChildPosts($childPosts) //表示するコメントの優先順位をつける
    {
        return $childPosts->sortBy(function ($post) {
        $hasDeletedAt = $post->deleted_at !== null ? 1 : 0;
            return [$post->likes->count(), $post->created_at];
        });
    }

    public function is_liked_by_auth_user()
    {
        $id = Auth::id();
    
        $likers = array();
        foreach($this->likes as $like) {
          array_push($likers, $like->user_id);
        }
    
        if (in_array($id, $likers)) {
          return true;
        } else {
          return false;
        }
    }
}
        /*foreach($posts as $post){
            if($post->anonymity==1) $post['user_id']='NULL';
        }*/