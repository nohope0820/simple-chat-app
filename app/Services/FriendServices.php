<?php

namespace App\Services;

use App\Repositories\FriendRepository;

class FriendServices
{
    protected $friendRepository;

    public function __construct(FriendRepository $friendRepository)
    {
        $this->friendRepository = $friendRepository;
    }

    public function haveFriend($requestId, $acceptId)
    {
        return $this->friendRepository->haveFriend($requestId, $acceptId);
    }

    public function statusOfFriend($requestId, $acceptId)
    {
        return $this->friendRepository->statusFriend($requestId, $acceptId);
    }

    public function friendRequest($acceptId)
    {
        return $this->friendRepository->friendRequest($acceptId);
    }

    public function addFriend($requestId, $acceptId)
    {
        $params['request_id'] = $requestId;
        $params['accept_id'] = $acceptId;
        $params['status'] = '0';
        return $this->friendRepository->store($params);
    }

    public function unFriend($requestId, $acceptId)
    {
        return $this->friendRepository->destroy($requestId, $acceptId);
    }

    public function acceptFriend($requestId, $acceptId)
    {
        return $this->friendRepository->accept($requestId, $acceptId);
    }

    public function rejectFriend($requestId, $acceptId)
    {
        return $this->friendRepository->reject($requestId, $acceptId);
    }
}
