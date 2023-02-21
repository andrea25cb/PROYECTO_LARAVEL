<?php
   
namespace App\Http\Controllers\Auth;
   
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Illuminate\Http\Request;   
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
class GoogleSocialiteController extends Controller
{
    
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect()->name('login-google');
    }

    public function handleCallback()
    {

        // $user = Socialite::driver('google')->user();
        // //dd($user);

        // $userExists = User::where('external_id', $user->id)
        //     ->where('external_auth','google')
        //     ->exists();

        // if($userExists){
        //     Auth::login($userExists);
        // }else{
        //   $userNew =  User::create([
        //         'name' => $user->name,
        //         'username' => $user->email,
        //         // 'nickname' => $user->username,
        //         'password' => encrypt('gitpwd059'),
        //         'email' => $user->email,
        //         'avatar' => $user->avatar,
        //         'external_id' => $user->id,
        //         'external_auth' => 'google',
        //     ]);

        //     Auth::login($userNew);
        // }
     
        // return redirect('/');
       
        $googleUser = Socialite::driver('google')->user();

            $user = User::updateOrCreate([
                'external_id' => $googleUser->id,
            ], [
                'name' => $googleUser->name,
                'username' => $googleUser->email,
                'email' => $googleUser->email,
                'avatar' => $googleUser->avatar,
                'password' => encrypt('gitpwd059'),
                'external_id' => $googleUser->id,
                'external_auth' => 'google', //provider
            ]);
         
            Auth::login($user);
    
            return redirect('/');
}
}