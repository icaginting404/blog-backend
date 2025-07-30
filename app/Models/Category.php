<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Illuminate\Database\Relations\HasMany;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable=[
        'name',
        'category',
        'slug'
    ];

    protected static function boot(){
        parent::boot();

       static::saving(function ($category) {
            if (empty($category->slug) || $category->isDiry('name')){
                $category->slug = Str::slug($category->name);
            }
        });
    }}