<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class invitation extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'board_id', 'status',
    ];
}
