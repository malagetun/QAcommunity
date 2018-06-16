<?php

namespace App\Http\Controllers;

use App\Notifications\NewUserFollowNotification;
use App\Repositories\UserRepository;

use Illuminate\Http\Request;
use Auth;
use App\User;

class FollowerController extends Controller
{
    protected $user;

    /**
     * FollowerController constructor.
     *
     * @param $user
     */
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    //
    public function index(Request $request){


        $user=$this->user->byId($request->get('user'));

        $followers=$user->followersUser()->pluck('follower_id')->toArray();
        if(in_array(user('api')->id,$followers)){
                return response()->json(['followed'=>true]);
        }
        return response()->json(['followed'=>false]);
    }
    public function follow(){
        $userToFollow = $this->user->byId(request('user'));

        $followed = Auth::guard('api')->user()->followThisUser($userToFollow->id);

        if(count($followed['attached'])> 0 ){



            $userToFollow->increment('followers_count');
            $userToFollow->notify(new NewUserFollowNotification());
            Auth::guard('api')->user()->increment('followings_count');
//            Auth::user()->increment('followings_count');
            return response()->json(['followed' => true]);
        }

        $userToFollow->decrement('followers_count');
        return response()->json(['followed' => false]);
    }
}
