<?php


namespace Modules\User\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\User\Entities\Sentinel\User;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class MobileController extends Controller
{

    public function __construct()
    {
    }

    public function register(Request $request)
    {
        try {
            $user = new User();
            $user->email = $request['email'];
            $user->first_name = $request['first_name'];
            $user->last_name = $request['last_name'];
            $user->password = bcrypt($request['password']);
            $user->is_mobile = true;
            $user->save();

            return response()->json([
                'errors' => 'false',
                'data' => $user,
            ],
                200
            );
        } catch (\Exception $e) {
            return response()->json([
                'errors' => 'true',
                'data' => $e,
            ],
                500
            );
        }

    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!$token = JWTAuth::attempt($credentials)) {
            return response([
                'errors' => 'true',
                'msg' => 'Invalid Credentials.'
            ], 400);
        }
        return response([
            'errors' => 'false',
            'token' => $token
        ]);
    }

    public function logout(Request $request) {
        $this->validate($request, ['token' => 'required']);

        try {
            JWTAuth::invalidate($request->input('token'));
            return response([
                'errors' => 'false',
                'msg' => 'You have successfully logged out.'
            ]);
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response([
                'errors' => 'true',
                'msg' => 'Failed to logout, please try again.'
            ]);
        }
    }

    public function user(Request $request)
    {
        dd($request->header('Authorization'));
    }
}