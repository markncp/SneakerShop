<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

use DB;
class User extends Model
{
    protected $table = 'users';

    protected $primaryKey = 'id';


    protected $fillable = ['firstname','lastname', 'email', 'username','password','phone', 'addressdetail', 'type',
        'road', 'province', 'subdistrict', 'district', 'zipcode', 'imageFileName'
    ];

    public static function login($username,$password)
    {   

        return DB::table('users')
                ->select('*')
                ->where('username', $username)
                ->Where('password', hash('sha256',$password."34ABcd#$"))
                //->Where('isActive', 1)
                ->first();
                
    }

    
}
