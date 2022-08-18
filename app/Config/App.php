<?php

namespace App\Config;

use App\Config\Database;

class App {
    
    public Database $db;

    public function __construct() 
    {
        $this->db = new Database();
    }
}