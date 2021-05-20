<?php

namespace App\Http\Controllers\Api\Room;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\RoomServices;
use Illuminate\Support\Facades\Validator;

class StoreController extends Controller
{
    protected $roomServices;

    public function __construct(RoomServices $roomServices)
    {
        $this->roomServices = $roomServices;
    }

    public function main(Request $request)
    {
        $validator = $this->getValidator($request);
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()
            ], 422);
        }
        $params = $this->getParams($request);
        $room = $this->roomServices->store($request->userId, $params);
        return response()->json(["room" => $room], 200);
    }

    private function getValidator(Request $request)
    {
        return Validator::make($request->all(), [
            'name' => 'bail|required|min:1|max:100',
        ]);
    }

    private function getParams(Request $request)
    {
        return $request->only(['name']);
    }
}
