<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class posts extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        "title",
        "slug",
        "body",
        "author_id",
        "category_id",
        "status",
        "tumbnail",
    ];

    protected static function boot(){
        parent::boot();

        static::saving(function ($post){
            if (empty($post->slug)|| $post->isDirty('title')){
                $post->slug = Str::slug($post->title);

            }
        
    });

    static::creating(function($post){
        $post->author_id = Auth::id();
    });
}
public function post(): HasMany
{
    return $this->hasMany(posts::class);
}
public function category():BelongsTo{
    return $this->belongsTo(Category::class);
}

public function author():BelongsTo{
    return $this->belongsTo(User::class);
}
}
