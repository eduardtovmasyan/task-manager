<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'create_by',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'users_boards', 'board_id', 'user_id')
                   ->withTimestamps();
    }

    public function lists()
    {
        return $this->hasMany(BoardList::class);
    }

    public function tasks()
    {
        return $this->hasManyThrough(
            Task::class,
            BoardList::class,
            'board_id',
            'list_id'
        );
    }
}
