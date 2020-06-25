<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
	const STATUS_PENDING = 'pending';
	const STATUS_ACCEPTED = 'accepted';
	const STATUS_REJECTED = 'rejected';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'board_id', 'status',
    ];

    public function board()
    {
        return $this->belongsTo(Board::class);
    }
}
