<?php
    
    use App\Models\User;
    
    require __DIR__ . './autoload.php';
    //проверяем наличие таблицы в БД, при отсутствии - создаем
    User::checkTable();
    
    $url = explode('/', $_SERVER['REQUEST_URI']);
    $ctrlRequest = !empty($url[1]) ? $url[1] : 'Users';
    $ctrlClassName = '\App\Controllers\\' . ucfirst($ctrlRequest);
    $controller = new $ctrlClassName;
    $actionRequest = !empty($url[2]) ? $url[2] : 'Index';
    $param = !empty($url[3]) ? $url[3] : '';
    $actionName = ucfirst($actionRequest);
    if ($param) {
        $controller->action($actionName, $param);
    } else {
        $controller->action($actionName);
    }