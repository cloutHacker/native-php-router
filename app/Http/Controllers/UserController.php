<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Interfaces\Validation\Request;

class UserController extends Controller
{
        //
        public function register(Request $request)
        {
          $request->validate($request, [
            'username' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|max:200|confirmed'
          ]);
          if ($request->hasErrors()) {
                var_dump($request->errors());
           } else {
                echo "passed the validation";
          }
        }
        public function home($name, $title) {
                return $this->view('home',['name' => $name, 'title' => $title]);
        }
}
