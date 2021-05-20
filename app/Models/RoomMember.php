<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomMember extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'room_id',
        'member_id',
    ];
}
