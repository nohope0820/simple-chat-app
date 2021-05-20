<?php

namespace App\Http\Controllers\Api\Profile;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Services\ProfileServices;

class UpdateController extends Controller
{
    public $profileServices;

    public function __construct(ProfileServices $profileServices)
    {
        $this->profileServices = $profileServices;
    }

    public function main(Request $request)
    {
        $validator = $this->getValidator($request);
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()], 422);
        }
        $params = $this->getParams($request);
        $this->profileServices->updateProfile($request->userId, $params);
        return response()->json([], 200);
    }

    public function getValidator(Request $request)
    {
        return Validator::make($request->all(), [
            'address' => 'bail|required|min:5|max:100',
            'phone' => 'bail|min:10|max:11',
            'date_of_birth' => 'bail|min:8|max:100',
            'gender' => 'bail|required|min:2|max:10',
            'graduate' => 'bail|min:5|max:100',
        ]);
    }

    private function getParams(Request $request)
    {
        return $request->only(['address', 'phone', 'date_of_birth', 'gender', 'graduate']);
    }
}
