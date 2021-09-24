<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

const ADMIN_TYPE = 1;
const DEFAULT_TYPE = 0;


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
    protected $redirectTo = '/home';

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
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            
            'firstname' => ['required', 'string', 'max:100'],
            'lastname' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'username' => ['required', 'string', 'max:255','unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['required', 'string', 'max:12'],
            'addressdetail' => ['required', 'string', 'max:255'],
            'road' => ['required', 'string', 'max:100'],
            'province' => ['required', 'string', 'max:100'],
            'subdistrict' => ['required', 'string', 'max:100'],
            'district' => ['required', 'string', 'max:100'],
            'zipcode' => ['required', 'string', 'max:5'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        // dd($data);
        //echo $data['password']."=".Hash::make($data['password']);
        //die();
        return User::create([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'username' => $data['username'],
            'password' => hash('sha256',$data['password']."34ABcd#$"),
            'phone' => $data['phone'],
            'type' => DEFAULT_TYPE,
            'addressdetail' => $data['addressdetail'],
            'road' => $data['road'],
            'province' => $data['province'],
            'subdistrict' => $data['subdistrict'],
            'district' => $data['district'],
            'zipcode' => $data['zipcode'],
            //'Active'=> ['1'],
        ]);
        //     User::create([
        //         'firstname' => $data['firstname'],
        //         'lastname' => $data['lastname'],
        //         'email' => $data['email'],
        //         'username' => $data['username'],
        //         'password' => hash('sha256',$data['password']."34ABcd#$"),
        //         'phone' => $data['phone'],
        //         'type' => DEFAULT_TYPE,
        //         'addressdetail' => $data['addressdetail'],
        //         'road' => $data['road'],
        //         'province' => $data['province'],
        //         'subdistrict' => $data['subdistrict'],
        //         'district' => $data['district'],
        //         'zipcode' => $data['zipcode'],
        //         //'Active'=> ['1'],
        //     ]);

        // return redirect('auth/login')->with('flash_message', 'Product added!');
    }
}
