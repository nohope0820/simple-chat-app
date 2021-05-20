<?php

namespace App\Http\Controllers\Api\Profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ProfileServices;

class IndexController extends Controller
{
    public $profileServices;

    public function __construct(ProfileServices $profileServices)
    {
        $this->profileServices = $profileServices;
    }

    public function main(Request $request)
    {
        $profile = $this->profileServices->profile($request->userId);
        return response()->json(['profile' => $profile], 200);
    }
}
