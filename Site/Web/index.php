<?php
/**
 * Created by PhpStorm.
 *
 * @author 曾洪亮<zenghongl@126.com>
 * @email  zenghongl@126.com
 * User: whosafe
 * Date: 2018/6/25
 * Time: 上午9:18
 */
use BaseYaf as Y;
define("ROOT", dirname(__FILE__,3) . '/');
define('SITE', 'Web');
define('ENV', 'dev');


$app = new \Yaf\Application(ROOT . 'Config/' . SITE . '.ini');

$y = Y::web();
if(is_object($y)){
    $y->response();
}
