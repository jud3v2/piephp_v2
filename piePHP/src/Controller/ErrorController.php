<?php

namespace Controller;

use Core\Controller;

class ErrorController extends Controller
{
    public function __construct()
    {
            parent::__construct();
    }

    public function giveError(
        int $status = 404,
        string $title,
        string $message = 'Ressource non disponible',
        string $redirectTo = null
    ) {
            $this->render("error.index", [
                'title' => $title,
                'message' => $message,
                'status' => $status,
                'redirectTo' => $redirectTo
            ]);
            die();
    }
}
