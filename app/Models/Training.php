<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Training extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'shared',
        'active'
    ];

    /**
     * The jobs this training uses.
     */
    public function job(): BelongsToMany
    {
        return $this->belongsToMany(Job::class);
    }

    /**
     * Get the content for the training module.
     */
    public function content(): HasMany
    {
        return $this->hasMany(Training_Content::class);
    }
}
