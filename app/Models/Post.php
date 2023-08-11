<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'titele',
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
        return $this->belongToMany(Post::class);
    }
    
    public function tags()
    {
        return $this->belongsToMany(Post::class);
    }
    
    public function user()
    {
        return $this->belongTo(Post::class);
    }
    
    public function post()
    {
        return $this->belongTo(Post::class);
    }
    
    public function types()
    {
        return $this->belongTo(Post::class);
    }
    
    public function trouble_getByLimit(int $limit_count = 5)
    {
        return $this->where('type_id','1')->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
}
