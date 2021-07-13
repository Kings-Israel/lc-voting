<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Idea extends Model
{
    use HasFactory, Sluggable;

    const PAGINATION_COUNT = 10;

    protected $guarded = [];

    /**
     * Get the user that owns the Idea
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    /**
     * Get the category that owns the Idea
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the status that owns the Idea
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    /**
     * Get the idea that owns the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function votes(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'votes');
    }

    public function isVotedByUser(?User $user)
    {
        if(!$user) {
            return false;
        }
        return Vote::where('user_id', $user->id)->where('idea_id', $this->id)->exists();
    }

    public function vote(User $user)
    {
        Vote::create([
            'idea_id' => $this->id,
            'user_id' => $user->id,
        ]);
    }

    public function removeVote(User $user)
    {
        Vote::where([
            'idea_id' => $this->id,
            'user_id' => $user->id,
        ])->first()->delete();
    }
}
