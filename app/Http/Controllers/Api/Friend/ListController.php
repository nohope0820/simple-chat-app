<?php

namespace App\Http\Controllers\Api\Friend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\UserServices;

class ListController extends Controller
{
    protected $userServices;

    public function __construct(UserServices $userServices)
    {
        $this->userServices = $userServices;
    }

    public function index(Request $request)
    {
        $listFriend = $this->userServices->listFriend($request->userId);
        return response()->json(['listFriend' => $listFriend], 200);
    }
}
