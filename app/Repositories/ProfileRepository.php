<?php

namespace App\Repositories;

use App\Models\Profile;

class ProfileRepository extends Repository
{
    protected $profile;

    public function __construct(Profile $profile)
    {
        $this->profile = $profile;
    }

    public function profile($userId)
    {
        return $this->profile->join('users', 'users.id', '=', 'profiles.user_id')
                             ->where('profiles.user_id', '=', $userId)
                             ->select(['users.name', 'profiles.address', 'profiles.phone',
                             'profiles.gender', 'profiles.date_of_birth', 'profiles.graduate'])
                             ->get();
    }

    public function updateProfile($userId, array $params)
    {
        $params['user_id'] = $userId;
        $query = $this->profile->where('user_id', '=', $userId)->get();
        $count = $query->count();
        if ($count == 0) {
            $profile = $this->profile->create($params);
        } else {
            $profile = $this->profile->where('user_id', '=', $userId)
                                     ->update(['address' => $params['address'],
                                               'phone' => $params['phone'],
                                               'date_of_birth' => $params['date_of_birth'],
                                               'gender' => $params['gender'],
                                               'graduate' => $params['graduate']
                                               ]);
        }
        return $profile;
    }
}
