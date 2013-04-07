<?php
/**
 *
 */
class Router
{
    /**
     *  根据 $_SERVER['REQUEST_URI'] 获取 module, controller, action
     */
    public static function getRoute($requestUrl)
    {
        $requestUrl = strtolower(trim($requestUrl));

        if (strpos($requestUrl, 'index.php') !== false)
        {
            $requestUrl = substr($requestUrl, strpos($requestUrl, 'index.php') + 9);
        }

        // 第一个字符可能是 /
        if (substr($requestUrl, 0, 1) === '/')
        {
            $requestUrl = substr($requestUrl, 1);
        }

        // 去掉 query string
        if (strpos($requestUrl, '?') !== false)
        {
            $requestUrl = substr($requestUrl, 0, strpos($requestUrl, '?'));
        }

        $pathArray = explode('/', $requestUrl);

        $module     = 'index';
        $controller = 'index';
        $action     = 'index';

        switch (count($pathArray))
        {
            case 1:
                if ($pathArray[0] != '')
                {
                    $action = $pathArray[0];
                }
                break;
            case 2:
                $controller = $pathArray[0];
                if ($pathArray[1] != '')
                {
                    $action = $pathArray[1];
                }
                break;
            case 3:
                $module     = $pathArray[0];
                $controller = $pathArray[1];
                $action     = $pathArray[2];
                break;
            default:
                break;
        }

        $route = array();
        $route['module']     = $module;
        $route['controller'] = self::getControllerName($controller);
        $route['action']     = self::getActionName($action);

        return $route;
    }

    private static function getControllerName($controller)
    {
        $controllerName = '';

        $controllerArray = str_split($controller);

        $needToUpper = true;
        foreach ($controllerArray as $key => $value)
        {
            if ($value == '_' || $value == '-')
            {
                $needToUpper = true;
            }
            else
            {
                if ($needToUpper)
                {
                    $controllerName = $controllerName . strtoupper($value);
                }
                else
                {
                    $controllerName = $controllerName . $value;
                }

                $needToUpper = false;
            }
        }

        return $controllerName . 'Controller';
    }

    private static function getActionName($controller)
    {
        $controllerName = '';

        $controllerArray = str_split($controller);

        $needToUpper = false;
        foreach ($controllerArray as $key => $value)
        {
            if ($value == '_' || $value == '-')
            {
                $needToUpper = true;
            }
            else
            {
                if ($needToUpper)
                {
                    $controllerName = $controllerName . strtoupper($value);
                }
                else
                {
                    $controllerName = $controllerName . $value;
                }

                $needToUpper = false;
            }
        }

        return $controllerName . 'Action';
    }
}