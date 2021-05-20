<?php

namespace App\Http\Controllers\Api\FriendRequest;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\FriendServices;

class AcceptController extends Controller
{
    protected $friendServices;

    public function __construct(FriendServices $friendServices)
    {
        $this->friendServices = $friendServices;
    }

    public function main(Request $request)
    {
        $acceptId = $request->route('id');
        $this->friendServices->acceptFriend($request->requestId, $acceptId);
        $invitation = $this->friendServices->friendRequest($request->acceptId);
        return response()->json(['invitation' => $invitation], 200);
    }
}
