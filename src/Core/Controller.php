<?php
    class Controller{
        protected function render(string $view, array $params = []){
            $viewFile = __DIR__ . '/../Views/' . $view . '.php';
            extract($params);

            ob_start();
            require $viewFile;
            return ob_get_clean();
        }
    }