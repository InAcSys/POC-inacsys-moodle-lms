<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use MoodleRest;

class UserController extends Controller
{
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|min:10',
            'firstname' => 'required|string|min:3',
            'lastname' => 'required|string|min:3',
            'email' => 'required|email',
            'password' => 'required|string|min:8'
        ]);

        if ($validator->fails())
        {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $new_user = array(
            'users' => array(
                array(
                    'username' => $request['username'],
                    'firstname' => $request['firstname'],
                    'lastname' => $request['lastname'],
                    'email' => $request['email'],
                    'createpassword' => 0,
                    'password' => $request['password']
                )
            )
        );

        $rest = new MoodleRest(env('MOODLE_API_URL'), env('MOODLE_API_TOKEN'));
        $rest->request('core_user_create_users', $new_user, MoodleRest::METHOD_POST);
    }
}
