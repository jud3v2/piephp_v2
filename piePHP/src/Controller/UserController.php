<?php

namespace Controller;

use Core\Controller;
use JetBrains\PhpStorm\NoReturn;
use Model\UserModel;

class UserController extends Controller
{
    public function __construct()
    {
            parent::__construct();
    }

        /**
         * @return void
         */
        #[NoReturn] public function index(): void
        {
                $users = (new UserModel())->getUsers();
                $this->render('user.index', compact('users'));
        }

        /**
         * @param string $message
         * @return void
         */
        public function show(string $message = ''): void
        {
                $this->render('user.register', ['message' => $message]);
        }

        /**
         * @return void
         */
        #[NoReturn] public function store(): void
        {
                $data = [
                    'email' => $_POST['email'],
                    'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                    'firstname' => $_POST['firstname'],
                    'lastname' => $_POST['lastname'],
                    'birthdate' => $_POST['birthdate']
                ];

                $user = new UserModel();
                $user->setEmail($data['email']);
                $user->setPassword($data['password']);
                $user->setFirstname($data['firstname']);
                $user->setLastname($data['lastname']);
                $user->setBirthdate($data['birthdate']);
                if ($user->createUser()) {
                        $this->headerRedirect('/login');
                } else {
                        $this->redirect('/register');
                }
        }

        /**
         * @return void
         */
        #[NoReturn] public function showLogin(): void
        {
                $this->render('user.login');
        }

        /**
         * @return void
         */
        #[NoReturn] public function showDelete(): void
        {
                $this->render('user.showDelete');
        }

        /**
         * @return void
         */
        #[NoReturn] public function login(): void
        {
                $data = [
                    'email' => $_POST['email'],
                    'password' => $_POST['password']
                ];

                $user = new UserModel();

                $user = $user->getUserByEmail($data['email']);
                if ($user && password_verify($data['password'], $user['password'])) {
                        echo "Session started";
                        $_SESSION['user'] = $user;
                        $this->headerRedirect('/profile');
                } else {
                        $this->headerRedirect('/login');
                }
        }

        /**
         * @param $message
         * @return void
         */
        #[NoReturn] public function showProfile($message = ''): void
        {
                $this->isLoginOrRedirect();
                $user = new UserModel();
                $user = $user->getUserById($_SESSION['user']['id']);
                $this->render('user.show', ['user' => $user, 'message' => $message]);
        }

        /**
         * @return void
         */
        #[NoReturn] public function showUpdateProfile(): void
        {
                $this->isLoginOrRedirect();
                $user = $_SESSION['user'];
                $this->render('user.update', ['user' => $user]);
        }

        /**
         * @param $id
         * @return void
         */
        #[NoReturn] public function userUpdate($id): void
        {
                $this->isLoginOrRedirect();
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                    $this->redirect('/profile');
            }
                $user = new UserModel();
                $user->getUserById($id);
                $user->setEmail($_POST['email']);
                $user->setFirstname($_POST['firstname']);
                $user->setLastname($_POST['lastname']);
                $user->setBirthdate($_POST['birthdate']);
                $user->setAddress($_POST['address']);
                $user->setCity($_POST['city']);
                $user->setZipcode($_POST['zipcode']);
                $user->setCountry($_POST['country']);
                $user->updateUser($_POST);

                $_SESSION['user'] = $user->getUserById($id);
                $this->redirect('/profile', ['message' => 'User updated']);
        }

        /**
         * Delete an user from DB
         * @param $id
         * @return void
         */
        #[NoReturn] public function userDelete($id): void
        {
                $this->isLoginOrRedirect();
            if (password_verify($_POST['password'], $_SESSION['user']['password'])) {
                    $user = new UserModel();
                if ($user->deleteUser($_SESSION['user']['id'])) {
                        session_destroy();
                        session_abort();
                        $this->redirect('/register', ['message' => 'User deleted']);
                        die();
                }
            }

                $this->headerRedirect('/profile');
                die();
        }


        /**
         * @return void
         */
        #[NoReturn] public function logout(): void
        {
                $_SESSION = [];
                session_destroy();
                $this->headerRedirect('/');
        }
}
