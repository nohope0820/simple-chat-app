<?php

namespace App\Repositories;

use App\Models\Friend;

class FriendRepository extends Repository
{
    protected $friend;

    public function __construct(Friend $friend)
    {
        $this->friend = $friend;
    }

    public function haveFriend($requestId, $acceptId)
    {
        $query =  $this->friend->where([['request_id', '=', $requestId], ['accept_id', '=', $acceptId]])
                              ->orWhere([['request_id', '=', $acceptId], ['accept_id', '=', $requestId]])->get();
        return $query->count();
    }

    public function statusFriend($requestId, $acceptId)
    {
        return $this->friend->where([['request_id', '=', $requestId], ['accept_id', '=', $acceptId]])
                              ->orWhere([['request_id', '=', $acceptId], ['accept_id', '=', $requestId]])->first();
    }

    public function friendRequest($acceptId)
    {
        return $this->friend->join('users', 'friends.accept_id', '=', 'users.id')
                           ->where(['request_id' => $acceptId,
                                    'status' => 0])
                           ->select('users.name', 'users.id')
                           ->get();
    }

    public function destroy($requestId, $acceptId)
    {
        return $this->friend->where([['request_id', '=', $requestId],
                                    ['accept_id', '=', $acceptId]])
                            ->orWhere([['request_id', '=', $acceptId],
                                       ['accept_id', '=', $requestId]])
                           ->delete();
    }

    public function accept($requestId, $acceptId)
    {
        return $this->friend->where([['request_id', '=', $requestId],
                                    ['accept_id', '=', $acceptId]])
                            ->orWhere([['request_id', '=', $acceptId],
                                       ['accept_id', '=', $requestId]])
                           ->update(['status' => 1]);
    }

    public function reject($requestId, $acceptId)
    {
        return $this->friend->where([['request_id', '=', $requestId],
                                    ['accept_id', '=', $acceptId]])
                            ->orWhere([['request_id', '=', $acceptId],
                                       ['accept_id', '=', $requestId]])
                           ->delete();
    }
}
