<?php

 namespace App\Http\Controllers;
        
use App\Http\Controllers\Controller;
use Illuminate\Support\Interfaces\Validation\Request;

 class UserController extends Controller
 {  
    //
    
    public function register() {
    
    	return $this->view("register");
    }
    
    public function login() {
       echo "login page";
    }
    public function registerValidate(Request $request) {
    	$request->validate($request->all(), [
    	"username" => "required|min:200"
    	]);
    	
    }
}