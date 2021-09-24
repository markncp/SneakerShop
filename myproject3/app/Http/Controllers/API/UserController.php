<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use DB;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $username = $request->get('username');
        $password = $request->get('password');
        $users = User::login($username,$password);
        if($users){
            $user = (array)$users;
            $user['message'] = 'success';
            $user['status'] = 'true';    
            //$user['token'] = sha1("user12345@09skl4#");        
        }else{
            $user = array(
                'message' => 'this user is not found', 
                'status' => 'false');
        }
        return response()->json($user);
        
    }

    public function view($id)
    {
        $sql="SELECT * FROM users 
        INNER JOIN user_type ON users.type=user_type.type
        WHERE users.id=$id";
        $user=DB::select($sql)[0];         
        return response()->json($user);
    }
    
    public function create(Request $request)
    {
        //validate file uploading,  where image works for jpeg, png, bmp, gif, or svg
        $this->validate($request, ['file' => 'image']);

        //upload file
        $imageFileName = "";        
        $file = $request->file('file');
        if(isset($file)){
            $file->move(public_path('images/user'),$file->getClientOriginalName());
            $imageFileName = $file->getClientOriginalName();
        }        
        
        //add user data into users table
        $user = new User();
        $user->firstname = $request->get('firstname');
        $user->lastname = $request->get('lastname');   
        $user->email = $request->get('email');     
        $user->username = $request->get('username');
        $user->password = hash('sha256', $request->get('password')."34ABcd#$");  
        $user->phone = $request->get('phone');
        $user->addressdetail = $request->get('addressdetail');
        $user->road = $request->get('road');
        $user->province = $request->get('province');
        $user->subdistrict = $request->get('subdistrict');
        $user->district = $request->get('district');
        $user->zipcode = $request->get('zipcode');           
        $user->imageFileName = $imageFileName;   
        $user->type = 0;                        
        $user->save();                
        return response()->json(array(
            'message' => 'add a user successfully', 
            'status' => 'true'));   
    }
    
    public function update(Request $request, $id)
    {       
        //validate file uploading,  where image works for jpeg, png, bmp, gif, or svg
        $this->validate($request, ['file' => 'image']);

        $user = User::find($id);
        $user->firstname = $request->get('firstname');
        $user->lastname = $request->get('lastname');   
        $user->email = $request->get('email');     
        $user->username = $request->get('username');
        $user->password = hash('sha256', $request->get('password')."34ABcd#$");
        $user->phone = $request->get('phone');
        $user->addressdetail = $request->get('addressdetail');
        $user->road = $request->get('road');
        $user->province = $request->get('province');
        $user->subdistrict = $request->get('subdistrict');
        $user->district = $request->get('district');
        $user->zipcode = $request->get('zipcode');        
        $user->type = 0; 

        $file = $request->file('file');
        if(isset($file)){
            $file->move(public_path('images/user'),$file->getClientOriginalName());
            $user->imageFileName = $file->getClientOriginalName();
        }        

        $user->save();

        return response()->json(array(
            'message' => 'update a user successfully', 
            'status' => 'true'));
    }

    public function delete($id)
    {
        $sql="DELETE FROM users 
        WHERE id=$id";
        $user=DB::select($sql)[0];         
        return response()->json($user);
            
    }
    
}