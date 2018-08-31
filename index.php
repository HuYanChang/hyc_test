<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/31
 * Time: 10:19
 */

//应用目录为当前目录
define('APP_PATH', __DIR__);

//开启调试
define('APP_DEBUG', true);

//加载框架文件
require APP_PATH.'/hxphp/Hxphp.php';

//加载配置文件
$config = require  APP_PATH.'/config/config.php';

//实例化框架类
(new hxphp\Hxphp($config))->run();

