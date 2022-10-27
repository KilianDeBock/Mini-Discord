<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $avatar = '0.png';

        $user = User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'avatar_url' => $avatar,
            'password' => Hash::make($data['password']),
        ]);

        if ($data['avatar'] !== null) {
            $avatar = $data['avatar'];

            $avatar_file = $data['avatar'];
            if ($avatar_file) {
                $extention = $avatar_file->getClientOriginalExtension();
                $uploaded_path = $avatar_file->storeAs('public/users/avatars', $user->id . '.' . $extention);
                //haal enkel de filename op van het pad
                $filename = basename($uploaded_path);

                $user->avatar_url = $filename;
                $user->save();
            }
        }

        return $user;
    }
}
