<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    public function index() {
        return view('layout', [
            'page' => 'login.php',
            'title' => 'Login',
        ]);
    }

    public function login(Request $request) {
        $input = $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);

        $input['password'] = md5($input['password']);
        try {
            $user = User::where(['username' => $input['username'], 'password' => $input['password']])->first();
            if(!$user) {
                return view('layout', [
                    'error' => 'Unexpected error',
                    'message' => 'Invalid user, please try again'
                ]);
            }
            setcookie('username', $input['username'], time() + (86400 * 30), "/");
            return redirect('/branch');
        } catch (Exception $e) {
            return view('layout', [
                'page' => 'alert.php',
                'title' => 'Unexpected error',
                'message' => 'Unable to find user'
            ]);
        }

    }

    public function test() {
        $password = md5('admin');
        echo $password;
    }
}
