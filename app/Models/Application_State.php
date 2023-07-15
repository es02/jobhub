<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Application_state extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'successful',
        'rejected'
    ];

    /**
     * The State of the Application.
     */
    public function job(): BelongsToMany
    {
        return $this->belongsToMany(Job_Application::class);
    }
}
