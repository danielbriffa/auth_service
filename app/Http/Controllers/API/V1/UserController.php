<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\UserData;

class UserController extends Controller
{
    public function create(CreateUserRequest $request)
    {
        $input = $request->all();

        $input['password'] = bcrypt($input['password']);

        $user = User::create($input);
        //create a 1-1 row with the User Data
        UserData::create(['user_id' => $user->id]);

        //notify user
        $user->notify(new UserRegistered());

        return response()->json([
            'message' => 'User Created Successfully',
            'status_code' => 201
        ], 201);
    }
}
