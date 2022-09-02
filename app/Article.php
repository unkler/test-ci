<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Article extends Model
{
    protected $fillable = [
        'title',
        'body',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo('App\User');
    }

    public function likes(): BelongsToMany
    {
        return $this->belongsToMany('App\User', 'likes')->withTimestamps();
    }

    public function isLikedBy(?User $user): bool
    {
        return $user
            ? (bool)$this->likes->where('id', $user->id)->count()
            : false;
    }

    public function getCountLikesAttribute(): int
    {
        return $this->likes->count();
    }

    public function stocks(): BelongsToMany
    {
        return $this->belongsToMany('App\User', 'stocks')->withTimestamps();
    }

    public function isStockedBy(?User $user): bool
    {
        return $user ? (bool)$this->stocks->where('id', $user->id)->count()
            : false;
    }

    public function getCountStocksAttribute(): int
    {
        return $this->stocks->count();
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany('App\Tag')->withTimestamps();
    }

    public function comments(): HasMany
    {
        return $this->hasMany('App\Comment');
    }
}
