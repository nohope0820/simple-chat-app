<?php

namespace App\Http\Controllers\Api\messagePersonal;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\MessagePersonalServices;
use App\Events\RedisEvent;

class StoreController extends Controller
{
    protected $messagePersonalServices;

    public function __construct(MessagePersonalServices $messagePersonalServices)
    {
        $this->messagePersonalServices = $messagePersonalServices;
    }

    public function main(Request $request)
    {
        $senderId = $request->sender_id;
        $receiverId = $request->receiver_id;
        $validator = $this->getValidator($request);
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()
            ], 422);
        }
        $params = $this->getParams($request);
        
        $message = $this->messagePersonalServices->store($senderId, $receiverId, $params);
        event(new RedisEvent($message));
        return response()->json([], 201);
    }

    private function getValidator(Request $request)
    {
        return Validator::make($request->all(), [
            'messages' => 'bail|required|min:1',
        ]);
    }

    private function getParams(Request $request)
    {
        return $request->only(['messages']);
    }
}
