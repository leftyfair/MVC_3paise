<?php

namespace app\controllers;

use app\core\Application;
use app\core\Request;
use app\core\Router;

class SiteController extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function home($params = [])
    {
        return $this->render('home', $params);
    }
    public function Contact($params = [])
    {
        return $this->render('contact', $params);
    }
    public function handleContact(Request $request)
    {
        $body = $request->getBody();
        return "handle Contact";
    }
}
