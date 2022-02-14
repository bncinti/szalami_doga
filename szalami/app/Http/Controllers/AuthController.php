<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Validator;

class AuthController extends BaseController {

    public function register( Request $request ) {

        $validator = Validator::make( $request->all() , [

            "name" => "required",
            "email" => "required",
            "password" => "required",
            "confirm_password" => "required|same:password",
        ]);

        if( $validator->fails() ) {

            return $this->sendError( "Validálási hiba", $validator->errors() );
        }

        $input = $request->all();
        $input[ "password" ] = bcrypt( $input[ "password" ]);
        $user = User::create( $input );
        $success[ "name" ] = $user->name;

        return $this->sendResponse( $success, "Sikeres regisztráció" );
    }

    public function login( Request $request ) {

        if( Auth::attempt([ "email" => $request->email, "password" => $request->password ])) {

            $authUser = Auth::user();
            $success[ "token" ] = $authUser->createToken( "myapptoken" )->plainTextToken;
            $success[ "email" ] = $authUser->email;

            return $this->sendResponse( $success, "Sikeres bejelentkezés" );

        }else {

            return $this->sendError( "Sikertelen bejelentkezés", [ "error" => "Hibás adatok" ]);
        }
    }

    public function logout( Request $request ) {
        
        auth( "sanctum" )->user()->currentAccessToken()->delete();

        return response()->json('Sikeres kijelentkezés');
    }
}