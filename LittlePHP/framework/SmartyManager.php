<?php
/**
 * Created by JetBrains PhpStorm.
 * User: xianpengliu
 * Date: 13-4-7
 * Time: AM11:47
 */

require_once 'Smarty.class.php';

class SmartyManager
{
    private static $smarty = null;

    public static function getSmarty()
    {
        if (SmartyManager::$smarty == null)
        {
            SmartyManager::$smarty = new Smarty();
            SmartyManager::$smarty->caching      = false;
            SmartyManager::$smarty->config_dir   = SMARTY_CONFIG_DIR;
            SmartyManager::$smarty->template_dir = SMARTY_TPL_DIR;
            SmartyManager::$smarty->compile_dir  = SMARTY_COMPILE_DIR;
            SmartyManager::$smarty->cache_dir    = SMARTY_CACHE_DIR;
        }

        return SmartyManager::$smarty;
    }
}
