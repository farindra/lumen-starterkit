<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class UserController extends BaseController
{


    public function register(Request $request)
    {
        /* validation requirement */
        $validator = $this->validation('registration', $request);

        if($validator->fails()){

            return $this->core->setResponse('error', $validator->messages()->first(), NULL, false , 400  );
        }

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);
      
        /**Take note of this: Your user authentication access token is generated here **/
        $data['token'] =  $user->createToken(env('APP_NAME', 'Lumen'), [''])->accessToken;
        $data['firstname'] =  $user->firstname;
        $data['lastname'] =  $user->lastname;

        return response(['data' => $data, 'message' => 'Account created successfully!', 'status' => true]);
    }  
         
    /**
     * validation requirement
     *
     * @param  string $type
     * @param  request $request
     * @return object
     */
    private function validation($type = null, $request) {

        switch ($type) {

            case 'registration':

                $validator = [
                    'firstname' => 'required|max:50|min:2',
                    'lastname' => 'required|max:100|min:2',
                    'email' => 'required|email|unique:users',
                    'password' => 'required|min:6|max:100',
                ];
                
                break;

            default:
                
                $validator = [];
        }
        
        return Validator::make($request->all(), $validator);
    }
}