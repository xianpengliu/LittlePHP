<?php
/**
 *
 */
class Application
{
    /**
     *
     */
    public static function Start($route)
    {
        $module     = $route['module'];
        $controller = $route['controller'];
        $action     = $route['action'];

        $controllerFile = MODULE_DIR . "$module/$controller.php";

        if (! file_exists($controllerFile))
        {
            echo 'Controller not exists';
            exit;
        }

        try
        {
            require_once $controllerFile;

            $class = new ReflectionClass($controller);
            $method = $class->getMethod($action);
        }
        catch (Exception $e)
        {
            echo 'Controller/Action not exists';
            exit;
        }

        try
        {
            $method->invoke(null);
        }
        catch (Exception $e)
        {
            echo 'Action Exception';
            exit;
        }
    }
}