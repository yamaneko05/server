<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    use HasFactory;

    protected $with = ['user'];

    protected $appends = ['children_count', 'likers_count', 'like'];

    public function getLikeAttribute() {
        return $this->likers()->where('user_id', Auth::user()->id)->first();
    }

    public function getChildrenCountAttribute() {
        return $this->children()->count();
    }

    public function getLikersCountAttribute() {
        return $this->likers()->count();
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function children(): HasMany {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function parent(): BelongsTo {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function likers(): BelongsToMany {
        return $this->BelongsToMany(User::class, 'likes');
    }
}
