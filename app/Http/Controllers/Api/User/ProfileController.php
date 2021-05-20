<?php

namespace App\Http\Controllers\Api\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\FriendServices;
use App\Services\ProfileServices;

class ProfileController extends Controller
{
    protected $friendServices;
    protected $profileServices;

    public function __construct(FriendServices $friendServices, ProfileServices $profileServices)
    {
        $this->friendServices = $friendServices;
        $this->profileServices = $profileServices;
    }

    public function show(Request $request)
    {
        $acceptId = $request->route('id');
        
        $detail = $this->profileServices->profile($request->requestId);
        $isFriend = $this->friendServices->haveFriend($request->requestId, $acceptId);
        $status = $this->friendServices->statusOfFriend($request->requestId, $acceptId);
        return response()->json(['detail' => $detail,
                                 'isFriend' => $isFriend,
                                 'status' => $status], 200);
    }
}
