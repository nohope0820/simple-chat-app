<?php

namespace App\Http\Controllers\Api\Friend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ProfileServices;
use App\Services\FriendServices;

class StoreController extends Controller
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
        
        $this->friendServices->addFriend($request->requestId, $acceptId);
        return response()->json([], 200);
    }
}
