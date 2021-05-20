<?php

namespace App\Http\Controllers\Api\Room;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\RoomServices;

class ListController extends Controller
{
    protected $roomServices;

    public function __construct(RoomServices $roomServices)
    {
        $this->roomServices = $roomServices;
    }

    public function main(Request $request)
    {
        $roomOfUser = $this->roomServices->listofUser($request->userId);
        $roomOfAdmin = $this->roomServices->listofAdmin($request->userId);
        return response()->json([$roomOfUser, $roomOfAdmin], 200);
    }
}
