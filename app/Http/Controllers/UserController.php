<?php
namespace App\Http\Controllers;
        
 use App\Http\Controllers\Controller;
        
 class UserController extends Controller{
        //
        public function index($title, $name) {
            return $this->view('home', ['title' => $title, 'name' => $name]);
        }
}