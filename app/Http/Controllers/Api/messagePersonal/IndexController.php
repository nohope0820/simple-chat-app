<?php

namespace App\Http\Controllers\Api\messagePersonal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\MessagePersonalServices;

class IndexController extends Controller
{
    protected $messagePersonalServices;

    public function __construct(MessagePersonalServices $messagePersonalServices)
    {
        $this->messagePersonalServices = $messagePersonalServices;
    }

    public function main(Request $request)
    {
        $messages = $this->messagePersonalServices->find($request->senderId, $request->receiverId);
        return response()->json($messages, 200);
    }
}
