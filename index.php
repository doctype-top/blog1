<?php
    session_start();
    use library\Url;

    function __autoload($className){
        $fileName = 'core/'.str_replace('\\', '/', $className).'.class.php';
        if(!file_exists($fileName)){
            throw new Exception('Class not found!');
        }

        require_once $fileName;
    }
    $controllerName = Url::getSegment(0);
    $actionName = Url::getSegment(1);

    if(is_null($controllerName)){
        $controller = 'controllers\ControllerMain';
    }else{
        $controller = 'controllers\Controller'.ucfirst($controllerName);
    }

    if(is_null($actionName)){
        $action = 'actionIndex';
    }else{
        $action = 'action'.ucfirst($actionName);
    }

    try{
        $fileName = 'core/'.str_replace('\\', '/', $controller).'.class.php';
        if(!file_exists($fileName)){
            throw new library\HttpException('Not found', '404');
        }
        $controller = new $controller();
        if(!method_exists($controller, $action)){
            throw new library\HttpException('Not found', '404');
        }

        $controller->$action();
    }catch(\library\HttpException $e){
        header("HTTP/1.1 ".$e->getCode()." ".$e->getMessage());
        die($e->getMessage());
    }catch(Exception $e){
        die($e->getMessage());
    }