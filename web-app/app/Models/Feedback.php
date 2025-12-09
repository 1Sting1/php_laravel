<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Feedback extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'feedback';
    protected $fillable = [
        'name',
        'email',
        'message',
        'category_id',
        'is_reviewed',
    ];

    protected $casts = [
        'is_reviewed' => 'boolean',
        'created_at' => 'datetime',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
    public function scopeReviewed($query)
    {
        return $query->where('is_reviewed', true);
    }
    public function scopeByEmail($query, $email)
    {
        return $query->where('email', 'like', "%{$email}%");
    }
}
