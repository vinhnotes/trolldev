<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Overtrue\LaravelVote\Traits\Votable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Tags\HasTags;

use DB;

class Post extends Model
{
    use HasFactory;
    use Votable;
    use HasTags;

    protected $guarded = [];  
    
    protected $with = ['user', 'category'];

    public function user() 
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function replies() 
    {
        return $this->hasMany(Reply::class);
    }

    public static function popularTags()
     
    {
        return DB::table('taggables')
        ->selectRaw('id,name,slug, count(tag_id) as tagged_count')
        ->join('tags', 'tags.id', '=', 'taggables.tag_id')
        ->groupBy('tags.id')
        ->orderBy('tagged_count', 'desc')
        ->limit(50)
        ->get()

        ->map(function($tag){
            return [
                'name' => json_decode($tag->name),
                'slug' => json_decode($tag->slug),
                'id' => $tag->id,
                'count' => $tag->tagged_count
            ];
        });
    }
}
