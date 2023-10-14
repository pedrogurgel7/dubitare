<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany, HasOne};

class Question extends Model
{
    use HasFactory;

    protected $casts = [
        'draft' => 'boolean',
    ];
    /** @return HasMany<Vote> */
    public function votes(): HasMany
    {
        return $this->hasMany(Vote::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /** @return Attribute*/
    // public function likes(): Attribute
    // {

    //     return new Attribute(get: fn () => $this->votes->sum('like'));
    // }

    // /** @return Attribute*/
    // public function unlikes(): Attribute
    // {

    //     return new Attribute(get: fn () => $this->votes->sum('unlike'));
    // }
}
