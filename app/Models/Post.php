<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Post extends Model
{
    use HasFactory;
    
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
    
    public function posts()
    {
        return $this->hasMany(Post::class);
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
    
    public function post()
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
    
    public function getSearchPost($type_id, $search)
    {
        $limit_count = 5;
        $spaceConversion = mb_convert_kana($search, 's');
        $wordArraySearched = explode(' ', $spaceConversion);
            
        $posts = $this->where('post_id', NULL)->where('type_id', $type_id)
            ->where(function ($query) use ($wordArraySearched) {
                foreach ($wordArraySearched as $keyword) {
                    $query->where('title', 'like', '%' . $keyword . '%')
                        ->orWhere('body', 'like', '%' . $keyword . '%')
                        ->orWhereHas('tags', function ($subquery) use ($keyword) {
                          $subquery->where('name', 'like', '%' . $keyword . '%');
                      });
                }
            })->orderBy('updated_at', 'DESC')->paginate($limit_count);
        /*foreach($posts as $post){
            if($post->anonymity==1) $post['user_id']='NULL';
        }*/
        return $posts;
    }
    
    public function getPost($type_id){
        $limit_count=5;
        $posts = $this->where('post_id', NULL)->where('type_id', $type_id)->orderBy('updated_at', 'DESC')->paginate($limit_count);
        /*foreach($posts as $post){
            if($post->anonymity==1) $post['user_id']='NULL';
        }*/
        return $posts;
    }
    
    public function getReply()
    {
        return $this->where('post_id', $this->id)->orderBy('updated_at', 'DESC')->get();
    }
    
    public function getSource()
    {
        return $this->where('id', $this->post_id)->first();
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
