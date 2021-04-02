<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class UserController extends BaseController
{
    
    /**
     * register user
     *
     * @param  Request $request
     * @return Json
     */
    public function register(Request $request)
    {
        /* validation requirement */
        $validator = $this->validation('registration', $request);

        if ($validator->fails()) {

            return $this->core->setResponse('error', $validator->messages()->first(), NULL, false , 400  );
        }

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);

        return $this->core->setResponse('success', 'Account created successfully!', $user );
    }  

    public function login(Request $request) {

        /* validation requirement */
        $validator = $this->validation('login', $request);

        if ($validator->fails()) {

            return $this->core->setResponse('error', $validator->messages()->first(), NULL, false , 400  );
        }

        if ( $user = User::where('email', $request->email)->first() ) {

            if (Hash::check($request->password, $user->password)) {

                /**Take note of this: Your user authentication access token is generated here **/
                $data['token'] =  $user->createToken(env('APP_NAME', 'Lumen'), [''])->accessToken;
                $data['firstname'] =  $user->firstname;
                $data['lastname'] =  $user->lastname;

                return $this->core->setResponse('success', 'Login Success', $data );
            }
        }

        return $this->core->setResponse('error', 'Please check your email or password !', NULL, false , 400  );

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

            case 'login':

                $validator = [
                    'email' => 'required|string',
                    'password' => 'required|string',
                ];

                break;

            default:
                
                $validator = [];
        }

        return Validator::make($request->all(), $validator);
        
    }
    
    /**
     * user profile
     *
     * @return Json
     */
    public function profile() {

        return $this->core->setResponse('success', 'User Profile',  auth()->user());
    }
}