<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training_Content extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'page',
        'contemt'
    ];

    /**
     * Get the training module this content belongs to.
     */
    public function training(): BelongsTo
    {
        return $this->belongsTo(Training::class);
    }
}
