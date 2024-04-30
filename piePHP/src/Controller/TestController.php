<?php

namespace Controller;

use Core\Controller;
use JetBrains\PhpStorm\NoReturn;
use Model\TestModel;
use Model\UserModel;

class TestController extends Controller
{
    public function __construct()
    {
            parent::__construct();
    }

    #[NoReturn] public function index(): void
    {
            $users = (new TestModel())->getUsers();
        $this->render('test/index', ['users' => $users]);
    }
}
