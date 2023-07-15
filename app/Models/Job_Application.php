<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Job_Application extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'cv',
    ];

    /**
     * The State of the Application.
     */
    public function state(): BelongsToMany
    {
        return $this->belongsToMany(Application_State::class);
    }

    /**
     * Get the Job bring applied for.
     */
    public function job(): BelongsTo
    {
        return $this->belongsTo(Job::class);
    }

    /**
     * Get the Job bring applied for.
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
