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
        
        $githubUser = Socialite::driver('github')->user();
 
        $user = User::updateOrCreate([
            'external_id' => $githubUser->id,
        ], [
            'name' => $githubUser->name,
            'username' => $githubUser->nickname,
            'email' => $githubUser->email,
            'avatar' => $githubUser->avatar,
            'password' => encrypt('gitpwd059'),
            'external_id' => $githubUser->id,
            'external_auth' => 'github', //provider
        ]);
     
        Auth::login($user);

        return redirect('/');
}
}