<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/31
 * Time: 10:20
 */

namespace hxphp;

//框架根目录
define('CORE_PATH') or define('CORE_PATH', __DIR__);

/**
 * Class Hxphp
 * 框架核心
 * @package hxphp
 */
class Hxphp{
    //配置内容
    protected $config = [];
    public function __construct($config)
    {
        $this->config = $config;
    }

    //运行程序
    public function run()
    {
        spl_autoload_register(array($this, 'loadClass'));
    }
    //路由处理
    public function route()
    {
        $controllerName = $this->config['defaultController'];
        $actionName = $this->config['defaultAction'];
        $param = array();

        //获取到url
        $url = $_SERVER['REQUEST_URI'];
        $position = strpos($url, '?');
        $url = $position === false? $url: substr($url, 0, $position);
        $url = trim($url, '/');

        /**
         * 若url存在
         * 获取控制器名
         * 获取方法名
         */
        if($url){
            $urlArray = explode('/', $url);
            $urlArray = array_filter($urlArray);
            $controllerName = ucfirst($urlArray[0]);
            array_shift($urlArray); //删除数组第一个并该值
            $actionName = $urlArray ? $urlArray[0]:$actionName;
            array_shift($urlArray);
            $param = $urlArray ? $urlArray : array();
        }
        //判断是否存在控制器和方法
        $controller = 'app\\controllers\\'.$controllerName.'Controller';
        if(!class_exists($controller)){
            exit($controller."控制器不存在");
        }
        if(!method_exists($controller, $actionName)){
            exit($controller.'\\'.$actionName."方法不存在");
        }

        $dispatch = new $controller($controllerName, $actionName);
        // 也可以像方法中传入参数，以下等同于：$dispatch->$actionName($param)
        call_user_func_array(array($dispatch, $actionName), $param);
    }

    //检测开发环境
    public function setReporting()
    {
        if(APP_DEBUG === true){
            error_reporting(E_ALL);
            ini_set('display_errors', 'On');
        }else{
            ini_set('display_errors', 'Off');
            ini_set('log_errors', 'On');
        }
    }
}