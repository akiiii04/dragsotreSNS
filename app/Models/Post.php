<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Log;

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
        return $this->belongsTo(Post::class, 'post_id')->withTrashed();
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
    
    public function getReplies()
    {
        $depth = 5; //取得するコメントの数を制限
        $childPosts = $this->childposts;
        return $this->sortChildPosts($childPosts);
    }
    
    public function getReply()
    {
        $depth = 5; //取得するコメントの数を制限
        $childPosts = $this->childposts;
        return $this->sortChildPosts($childPosts)->first();
    }

    public function sortChildPosts($childPosts) //削除されていない投稿を最優先に、いいね数でソート
    {
        return $childPosts->sortByDesc(function ($post) {
        $hasDeletedAt = $post->deleted_at !== null ? 0 : 1;
            return [$hasDeletedAt, $post->likes->count()];
        });
    }
    
    public function showable_reply($depth)//表示可能な深さ内にある投稿に1つでも削除されていない投稿があればtrue
    {
        if($depth < 1 || $this==NULL) return false;
        else if($this->deleted_at == NULL) return true;
        else{
            foreach($this->childposts as $childpost){
                if($childpost->showable_reply($depth - 1)) return true;
            } 
        } 
        return false;
    }
    
    public function getParentList()
    {
        $parentList = array();
        if($this->post_id == NULL) return $parentList;
        else if($this->parentpost) return $this->parentpost->getParentList_item($parentList);
    }
    public function getParentList_item($parentList)
    {
        array_unshift($parentList,$this);
        if($this->post_id == NULL) return $parentList;
        else if($this->parentpost) return $this->parentpost->getParentList_item($parentList);
    }
    
    public function getMostParent()
    {
        if($this->post_id == NULL) return $this;
        else if($this->parentpost) return $this->parentpost->getMostParent();
    }
    
    public function set_anonymity()//匿名希望の投稿者が複数いても区別できるようにするためのもの
    {
        $anonymity['number'] = 1;
        $anonymity['flag'] = 0;
        
        $post = $this->getMostParent();
        
        $anonymity = $post->set_anonymity_item($anonymity, $this->user_id, $this->id);

            return $anonymity['number'];
    }
    public function set_anonymity_item($anonymity, $user_id, $id)
    {
        if($this->anonymity != 0 && $this->user_id == $user_id && $this->id != $id){
            $anonymity['number'] = $this->anonymity;
            $anonymity['flag'] = 1;
            return $anonymity;
        } 
        if($this->anonymity >= $anonymity['number'] && $this->user_id != $user_id) {
            $anonymity['number'] = $this->anonymity + 1;
        }
        if($this->childposts){
            foreach($this->childposts as $childPost){
                $anonymity = $childPost->set_anonymity_item($anonymity, $user_id, $id);
                if($anonymity['flag'] == 1)break;
                
            }
        }
        return $anonymity;
    }
    
    public function display_name()//数値化で保存されているanonymityをアルファベットに変換
    {
        $anonymity = $this->anonymity;
        if($anonymity == 0)return $this->user->name;
        else {
            if ($anonymity >= 1 && $anonymity <= 26) return "匿名投稿者".chr(64 + $anonymity);
            else return "無効な入力"; 
        }
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
    
    public function countReply()//削除済の投稿を含めずにカウント
    {
        return Post::where('post_id', $this->id)->count();
    }
}
        /*foreach($posts as $post){
            if($post->anonymity==1) $post['user_id']='NULL';
        }*/