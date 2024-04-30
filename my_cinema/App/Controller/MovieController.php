<?php

namespace App\Controller;

use App\Core\Controller;
use App\Core\View;

class MovieController extends Controller
{
    public function index()
    {
        $view = new View('movies.index');
        echo $view->render();
    }

    public function show($id)
    {
        return 'Identifiant du film que vous souhaiter regarder: ' . $id;
    }
}