<?php
   
namespace App\Http\Controllers\Auth;
   
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Illuminate\Http\Request;   
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
class GithubSocialiteController extends Controller
{
    public function gitRedirect()
    {
        return Socialite::driver('github')->redirect();
    }
       
    public function handleCallback()
    {
     
        $user = Socialite::driver('github')->user();
        //dd($user);

        $userExists = User::where('external_id', $user->id)
            ->where('external_auth','github')
            ->exists();

        if($userExists){
            Auth::login($userExists);
        }else{
          $userNew =  User::create([
                'name' => $user->name,
                'username' => $user->name,
                'nickname' => $user->username,
                'email' => $user->email,
                'avatar' => $user->avatar,
                'external_id' => $user->external_id,
                'external_auth' => 'github',
            ]);

            Auth::login($userNew);
        }
     
        return redirect('/');

}
}