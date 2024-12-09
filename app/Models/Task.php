<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class  Task extends Model
{
    use HasFactory;

    protected $table = 'tasks';

    protected $fillable = [
        'title',
        'description',
        'status',
        'priority',
        'parent_id',
        'user_id',
        'completed_at',
    ];

    protected $hidden = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /*public function tasks():HasMany
    {
        return $this->hasMany(Task::class);
    }

    public function childrenTasks(): HasMany
    {
        return $this->hasMany(Task::class, 'parent_id','id')->with('tasks');
    }*/

}
