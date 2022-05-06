<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register (Request $request){

     $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|confirmed'
        
    ]);
    

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $user->save();

        return response()->json(array(

            "status" => 200,
            "msg" => "Registro de usuario existoso"
        ));
    }
    public function login (Request $request){
        
            $request->validate([
                'email' => 'required',
                'password' => 'required'
            ]);
    
  $user = User::where("email",$request->email)->first();
  if(!$user){
      return response()->json(array('MSJ'=>'EL CORREO NO EXISTE'),422);
  }else{

  //  if(isset(user->id)){
        if(Hash::check($request->password, $user->password)){

            //creamos el token

                $token = $user->createToken("auth_token")->plainTextToken;

            //si esta todo correcto

            return response()->json([

                "status"=>1,
                "msg"=>"!usuario ingresado exitosamente!",
                "acces_token" => $token 
            ]);

        }else{
            return response()->json([

                "status"=>0,
                "msg"=>"!las password es incorrecta!"
            ],404);
        }

    }
    }
    public function userProfile (){
        
    }
    public function logout (){
        
    }
}
