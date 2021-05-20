<?php

namespace App\Repositories;

use App\Models\Room;
use App\Models\RoomMember;

class RoomRepository extends Repository
{
    protected $room;
    protected $roomMember;

    public function __construct(Room $room, RoomMember $roomMember)
    {
        $this->room = $room;
        $this->roomMember = $roomMember;
    }

    public function listOfUser($userId)
    {
        return $this->room->join('room_members', 'rooms.id', '=', 'room_members.room_id')
                           ->select('rooms.id', 'rooms.name')
                           ->where('room_members.member_id', '=', $userId)->get();
    }

    public function listOfAdmin($userId)
    {
        return $this->room->join('room_members', 'rooms.id', '=', 'room_members.room_id')
                           ->select('rooms.id', 'rooms.name')->get();
    }

    public function storeMember($params)
    {
        return $this->roomMember->create($params);
    }
}
