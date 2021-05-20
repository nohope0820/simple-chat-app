<?php

namespace App\Http\Controllers\Api\FriendRequest;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\FriendServices;

class ListController extends Controller
{
    protected $friendServices;

    public function __construct(FriendServices $friendServices)
    {
        $this->friendServices = $friendServices;
    }

    public function index(Request $request)
    {
        $invitation = $this->friendServices->friendRequest($request->acceptId);
        return response()->json(['invitation' => $invitation], 200);
    }
}
