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
            echo ResultManager::getResultJson(ResultManager::CODE_ERROR_ROUTE);
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
            echo ResultManager::getResultJson(ResultManager::CODE_ERROR_ROUTE);
            exit;
        }

        try
        {
            $method->invoke(null);
        }
        catch (Exception $e)
        {
            if (ini_get('display_errors'))
            {
                var_dump($e);
            }

            echo ResultManager::getResultJson(ResultManager::CODE_ERROR);
            exit;
        }
    }
}