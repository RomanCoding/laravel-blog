<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'body', 'user_id'];

    /**
     * A post belongs to a user who wrote it.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * A post can have many comments.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * A post can be associated with many tags.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * Get uri for a post.
     *
     * @return string
     */
    public function path()
    {
        return '/posts/' . $this->id;
    }

    /**
     * Add a comment to a post.
     */
    public function comment($data)
    {
        return $this->comments()->create($data);
    }

    public function getCommentsCountAttribute()
    {
        return $this->comments()->count();
    }

    public function scopePopular($query, $num = 10)
    {
        return $query->orderBy('comments_count', 'desc')->limit($num);
    }
}
