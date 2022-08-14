<?php

namespace App\Http\Controllers;

class ContactController extends Controller{
    function index() {
        echo "contact index page";
        return $this->view('homepage.css');
    }
}