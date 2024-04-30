<?php

namespace App\Controller;

use App\Core\Controller;
use App\Core\View;

class HomeController extends Controller
{
    public array $request;
    public function __construct($request)
    {
        $this->request = $request;
    }

    public function index()
    {
        $title = 'My Cinema Home';
        $view = new View('index', compact('title'));
        echo $view->render();
    }

    public function show($id)
    {
        return 'Identifiant du film que vous souhaiter regarder: ' . $id;
    }
}