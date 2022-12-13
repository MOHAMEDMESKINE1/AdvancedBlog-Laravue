<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'profile_img'=>'profile_img1.jpg',
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('programingVh')->accessToken;

        return response()->json(['token' => $token], 200);
    }

    /**
     * Handles Login Request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (auth()->attempt($credentials)) {
            $user = Auth::user();
          
            $token = $user->createToken('TutsForWeb')->accessToken;

            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['error' => 'UnAuthorised'], 401);
        }
    }

    /**
     * Returns Authenticated User Details
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function details()
    {
        return response()->json(['user' => Auth::user()], 200);
    }
    // NOTIFICATIONS !
    public function getAllNotifications(){

        $all_notifications =Auth::user()->notifications; 

        return response()->json($all_notifications);
    }
    public function getUnreadNotifications(){

        $unread_notifications =Auth::user()->unreadNotifications; 

        return response()->json($unread_notifications);
    }
    public function markNotificationAsRead(Request $request){

        $notification=Auth::user()->notifications()->where('id',$request->id)->first();
        $notification->markAsRead();
        return \response()->json(["message"=>"ok"]);
    }
}
