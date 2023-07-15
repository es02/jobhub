<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User_Role extends Model
{
    use HasFactory;
    
    /**
    * The table associated with the model.
    *
    * @var string
    */
   protected $table = 'user_role';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'hasMemberPerms',
        'hasEmployerPerms',
        'hasAdminAccess'
    ];

    /**
     * Get the users for the role.
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
