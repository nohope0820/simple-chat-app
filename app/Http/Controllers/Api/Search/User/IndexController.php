<?php

namespace App\Http\Controllers\Api\Search\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Services\UserServices;

class IndexController extends Controller
{
    protected $userServices;

    public function __construct(UserServices $userServices)
    {
        $this->userServices = $userServices;
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
        $list = $this->userServices->searchUser($params);
        return response()->json(["list" => $list], 200);
    }

    private function getValidator(Request $request)
    {
        return Validator::make($request->all(), [
            'find' => 'bail|required|min:2|max:100',
        ]);
    }

    private function getParams(Request $request)
    {
        return $request->only(['find']);
    }
}
