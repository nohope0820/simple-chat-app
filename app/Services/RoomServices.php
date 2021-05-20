<?php

namespace App\Services;

use App\Repositories\RoomRepository;

class RoomServices
{
    protected $roomRepository;

    public function __construct(RoomRepository $roomRepository)
    {
        return $this->roomRepository = $roomRepository;
    }

    public function store($userId, array $params)
    {
        $params['founder'] = $userId;
        $room = $this->roomRepository->store($params);
        $this->roomRepository->storeMember([
            'room_id' => $room->id,
            'member_id' => $userId()
        ]);
        return $room;
    }

    public function listOfUser($userId)
    {
        return $this->roomRepository->listOfUser($userId);
    }

    public function listOfAdmin($userId)
    {

        return $this->roomRepository->listOfAdmin($userId);
    }
}
