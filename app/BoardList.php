<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BoardList extends Model
{
    /**
     * @var string
     */
    protected $table = 'lists';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'board_id',
    ];

    public function board()
    {
        return $this->belongsTo(Board::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
