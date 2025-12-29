<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    //
    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'description',
        'priority',
        'status',
        'rating',
        'feedback_comment',
        'is_reopened',
        'reopened_at',
        'images',        
        'is_active',     
        'assigned_to',  
    ];
    protected $casts = [
        'images' => 'array',  // ← important for JSON
        'is_active' => 'boolean',
        'deleted_at' => 'datetime',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class)
            ->whereNull('parent_id')
            ->with('replies.user')
            ->orderBy('created_at');
    }
    public function assignedAgent()
{
    return $this->belongsTo(User::class, 'assigned_to');
}
}
