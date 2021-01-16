<?php


namespace app\core;


class Controller
{
    public string $layouts = 'main';

    public function setLayouts($layouts)
    {
        $this->layouts = $layouts;

    }

    public function render($view, $params = [])
    {
        $this->setLayouts($view);
        return Application::$app->router->renderView($view, $params);
    }

}