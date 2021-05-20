<?php

namespace App\Repositories;

use App\Models\Friend;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserRepository extends Repository
{
    protected $user;
    protected $friend;

    public function __construct(User $user, Friend $friend)
    {
        $this->user = $user;
        $this->friend = $friend;
    }

    public function detail($userId)
    {
        return $this->user->join('profiles', 'users.id', '=', 'profiles.user_id')
                          ->where('users.id', '=', $userId)->get();
    }

    public function listFriend($userId)
    {
        $tempJoinTable = "(
            select IF(request_id = $userId, accept_id, request_id) as user_id, status from friends 
            where request_id = $userId or accept_id = $userId
            ) as temp";
            return $this->user->select('users.name', 'users.email')
                ->join(DB::raw($tempJoinTable), function ($join) {
                    $join->on("temp.user_id", "=", "users.id")
                    ->where("temp.status", "=", "1");
                })->get();
    }

    public function search(array $params)
    {
        $find = $params["find"];
        return  $this->user->whereRaw("MATCH(name)AGAINST('.$find.' IN NATURAL LANGUAGE MODE)")->get();
    }
}
