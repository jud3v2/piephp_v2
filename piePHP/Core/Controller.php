<?php

namespace Core;

use Core\Router;

class Controller
{
        /**
         * @var string
         */
    protected string $render;

        /**
         * @var Request
         */
    protected Request $request;

    public function __construct()
    {
            // permet d'instancier la classe Request dans tous les enfants de la class controller
            $this->request = new Request();
    }

        /**
         * @deprecated use $this->render() instead
         * @param  string $view
         * @param  array  $data
         * @return void
         */
    public function view(string $view, array $data = []): void
    {
            // build view and check if the file exists
            $view = $_SERVER['DOCUMENT_ROOT'] . '/src/View/' . str_replace('.', '/', $view) . '.php';
            // Create buffer for send variable to view and extract data to pass variable to view.
            ob_start();
            extract($data);
            include_once $view;
            ob_end_flush();
    }

        /**
         * @param  $view
         * @param  array $data
         * @return void
         */
    public function render($view, array $data = []): void
    {
            $view = $_SERVER['DOCUMENT_ROOT']
                . '/src/View/'
                . ucfirst(str_replace('.', '/', $view)) . '.php';

        if (file_exists($view)) {
                ob_start();

                // render and cache the template
                (new TemplateEngine($view, $data))->render();

                // extract the data  to pass it to the view
                extract($data);

                // include the cached file previously parsed by the template engine
                include(new Cache($view))->getCacheFilePath();

                // get the content of the buffer
                                         $view = ob_get_contents();

                // clean the buffer
                ob_end_clean();

                // start buffering the layout
                ob_start();

                // render the view
                include $_SERVER['DOCUMENT_ROOT'] . "/src/View/index.php";

                // get the content of the buffer and clean it
                $this->render = ob_get_clean();

                // clean the buffer for next render
                ob_end_clean();
        } else {
            if (!file_exists($view)) {
                    $controller = 'Controller\\ErrorController';
                    $action = 'giveError';
                    $view = str_replace($_SERVER['DOCUMENT_ROOT'] . '/src/View/', '', $view);
                    $view = str_replace('/', '.', $view);
                    $view = str_replace('.php', '', $view);
                    Router::exec($controller, $action, [404, "View not found", "The view: [$view] does not exist"]);
                    die();
            }
        }
    }

        /**
         * redirect user to url
         * @param string $url
         * @param mixed $data
         * @return void
         */
    public function redirect(string $url, mixed $data = []): void
    {

        // send data to the view
        (new Core())->run($url, $data);
    }

        /**
         * redirect user to url with header 301
         * @param string $url
         * @return void
         */
    public function headerRedirect(string $url): void
    {
        http_response_code(301);
        header('Location : ' . $url);
        exit();
    }

    public function __destruct()
    {
            // check if headers have been sent to client
        if (!headers_sent()) {
                header('Content-Type: text/html');
            if (isset($this->render)) {
                echo $this->render;
            }
        }
    }

        /**
         * @return void
         */
    public function isLoginOrRedirect(): void
    {
        if (!isset($_SESSION['user'])) {
                session_destroy();
                $this->headerRedirect('/login');
        }
    }

        /**
         * @return bool
         */
    public function isLogin(): bool
    {
        if (isset($_SESSION['user'])) {
                return true;
        } else {
                return false;
        }
    }
}
