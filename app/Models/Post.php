<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'image_url',
        'video_url',
        'category_id',
        'flavours',
        'ingredients',
        'directions',
        'preparation_time',
        'cooking_time',
        'review',
        'is_published'
    ];

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    protected $casts = [
        'category_id' => 'array',
        'flavours' => 'array',
        'ingredient' => 'array',
      ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ownedBy(User $user) 
    {
        return $user->id === $this->user_id;
    }

    public function scopeFilter($query, array $filters)
    {
        if($filters['search'] ?? false)
        {
            $query->where('title', 'like', '%' . request('search') . '%')
            ->orWhere('description', 'like', '%' . request('search') . '%')
            ->orWhere('ingredients', 'like', '%' . request('search') . '%')
            ->orWhere('description', 'like', '%' . request('search') . '%')
            ->orWhere('flavours', 'like', '%' . request('search') . '%');
        }
        
        if($filters['category'] ?? false)
        {
            $query->where('category_id', 'like', '%' . request('category') . '%');
        }
    }
}
