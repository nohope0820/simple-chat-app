<?php

namespace App\Http\Controllers\Api\messagePersonal;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $senderId = Auth::id();
        $receiverId = $request->route('id');
        $messages = $this->messagePersonalServices->find($senderId, $receiverId);
        return response()->json($messages, 200);
    }
}
