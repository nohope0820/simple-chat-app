<?php

namespace App\Http\Controllers\Api\Friend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use app\Services\ProfileServices;
use App\Services\FriendServices;

class DestroyController extends Controller
{
    protected $friendServices;
    protected $profileServices;

    public function __construct(FriendServices $friendServices, ProfileServices $profileServices)
    {
        $this->friendServices = $friendServices;
        $this->profileServices = $profileServices;
    }

    public function main(Request $request)
    {
        $acceptId = $request->route('id');
        
        $detail = $this->profileServices->profile($request->requestId);
        $this->friendServices->unFriend($request->requestId, $acceptId);
        $isFriend = $this->friendServices->haveFriend($request->requestId, $acceptId);
        $status = $this->friendServices->statusOfFriend($request->requestId, $acceptId);
        return response()->json(['detail' => $detail,
                                 'isFriend' => $isFriend,
                                 'status' => $status], 200);
    }
}
