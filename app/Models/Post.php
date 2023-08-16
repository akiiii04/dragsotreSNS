<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    
    public function getByLimit($type_id)
    {
        $limit_count = 5;
        $posts = $this->where('post_id', NULL)->where('type_id', $type_id)->orderBy('updated_at', 'DESC')->paginate($limit_count);
        foreach($posts as $post){
            if($post->anonymity==1) $post['user_id']='NULL';
        }
        return $posts;
    }
    
        public function getReply()
    {
        return $this->where('post_id', $this->id)->orderBy('updated_at', 'DESC')->get();
    }


}
