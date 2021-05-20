<?php

namespace App\Services;

use App\Repositories\ProfileRepository;

class ProfileServices
{
    public $profileRepository;

    public function __construct(ProfileRepository $profileRepository)
    {
        $this->profileRepository = $profileRepository;
    }

    public function profile($userId)
    {
        return $this->profileRepository->profile($userId);
    }

    public function updateProfile($userId, array $params)
    {
        return $this->profileRepository->updateProfile($userId, $params);
    }
}
