<?php

namespace app\core;

class View //layout variables for rendering
{
    public string $title;

    protected function layoutContent()
    {
        $layout = Application::$app->layout;
        if(Application::$app->controller){
            $layout = Application::$app->controller->layout;
        }
        ob_start();
        include_once Application::$ROOT_DIR."/views/layouts/$layout.php";
        return ob_get_clean();
    }
//
//    protected function renderOnlyView($view):string{
//        ob_start();
//        include_once Application::$ROOT_DIR."/views/$view.php";
//        return ob_get_clean();
//    }
    public function renderView($view, $params = [])
    {
        $viewContent = $this->renderViewOnly($view, $params);
        $layoutContent = $this->layoutContent();
//        ob_start();
//        include_once Application::$ROOT_DIR.'/views/layouts/main.php';
//        $layoutContent = ob_get_clean();
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }



    public function renderViewOnly($view, $params = []) //params are passed to the view.
    {
        foreach ($params as $key => $value  ){
            $$key = $value; //declare variables as keys;
        }
        ob_start();
        include_once Application::$ROOT_DIR."/views/$view.php";
        return ob_get_clean();
    }

//    public function renderContent($viewContent, $params = [])
//    {
//        ob_start();
//        include_once Application::$ROOT_DIR.'/views/layouts/main.php';
//        $layoutContent = ob_get_clean();
//        return str_replace('{{content}}', $viewContent, $layoutContent);
//    }

}