<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'desc', 'list_id', 'assigned_to',
    ];

    public function list()
    {
        return $this->belongsTo(BoardList::class);
    }

    public function assignee()
    {
        return $this->belongsTo(User::class, 'assigned_to', 'id');
    }
}
