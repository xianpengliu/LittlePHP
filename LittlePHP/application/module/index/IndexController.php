<?php
/**
 *
 */

require_once 'BaseController.php';

class IndexController extends BaseController
{
    public static function indexAction()
    {
        require_once 'SmartyManager.php';

        $smarty = SmartyManager::getSmarty();
        $smarty->assign('name','Ned');
        $smarty->display('index.tpl');
    }
}