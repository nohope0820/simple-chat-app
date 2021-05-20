<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserServices
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        return $this->userRepository = $userRepository;
    }

    public function listFriend($userId)
    {
        return $this->userRepository->listFriend($userId);
    }

    public function searchUser(array $params)
    {
        return $this->userRepository->search($params);
    }
}
