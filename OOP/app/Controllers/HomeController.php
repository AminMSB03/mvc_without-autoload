<?php

use FTP\Connection;

require_once './app/core/View.php';
require_once './app/models/Base.php';

class HomeController 
{
    public function index(){
        

        $posts = new Base();
        $data['posts'] = $posts->join(1);

        View::load("home",$data);
    }

}