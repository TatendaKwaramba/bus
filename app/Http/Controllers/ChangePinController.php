<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;


class ChangePinController extends Controller
{
    public function admin_credential_rules(array $data)
    {
        $messages = [
            'current-password.required' => 'Please enter current password',
            'password.required' => 'Please enter password',
        ];

        $validator = Validator::make($data, [
            'current_password' => 'required',
            'password' => 'required|same:password',
            'password_confirmation' => 'required|same:password',
        ], $messages);

        return $validator;
    }

    public function postCredentials(Request $request)
    {
        if(Auth::Check())
        {
            $request_data = $request->All();
            $validator = $this->admin_credential_rules($request_data);
            if($validator->fails())
            {
                return 'Your PIN Confirmation does not match your new PIN!';
            }
            else
            {
                $current_password = Auth::User()->password;
                if(Hash::check($request_data['current_password'], $current_password))
                {
                    $user_id = Auth::User()->id;
                    $obj_user = User::find($user_id);
                    $obj_user->password = Hash::make($request_data['password']);
                    //$obj_user->pin = $request_data['password'];
                    $obj_user->save();
                    return 'PIN successfully changed!';
                }
                else
                {
                    $error = array('message' => 'Please enter correct current password');
                    return 'Please enter correct current PIN!';
                }
            }
        }
        else
        {
            return redirect()->to('/');
        }
    }

}