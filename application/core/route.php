<?php

/*
 * В этом файле опишем класс Route, который будет запускать методы контроллеров, 
 * которые в свою очередь будут генерировать вид страниц.
 */

class Route
{
    static function start()
    {
        // контроллер и действие по умолчанию
        $controller_name = 'Main';
        $action_name = 'index';

        $routes = explode('/', trim($_SERVER['REQUEST_URI'], '/'));    // breaking our URI in $routes[]

        // получаем имя контроллера
        if ( !empty($routes[1]) )
        {	
            $controller_name = $routes[1];
        }

        // получаем имя экшена
        if ( !empty($routes[2]) )
        {
            $action_name = $routes[2];
        }

        // добавляем префиксы
        $model_name = 'Model_' . $controller_name;
        $controller_name = 'Controller_' . $controller_name;
        $action_name = 'action_' . $action_name;

        // подцепляем файл с классом модели (файла модели может и не быть)

        $model_file = strtolower($model_name).'.php';
        $model_path = "application/models/" . $model_file;
        if(file_exists($model_path))
        {
            include "application/models/" . $model_file;
        }

        // подцепляем файл с классом контроллера
        $controller_file = strtolower($controller_name) . '.php';
        $controller_path = "application/controllers/" . $controller_file;
        if(file_exists($controller_path))
        {
            include "application/controllers/" . $controller_file;
        }
        else
        {
            /*
            правильно было бы кинуть здесь исключение,
            но для упрощения сразу сделаем редирект на страницу 404
            */
            Route::ErrorPage404();
        }

        // создаем контроллер
        $controller = new $controller_name;
        $action = $action_name;

        if(method_exists($controller, $action))
        {
            // вызываем действие контроллера
            $controller->$action();
        }
        else
        {
            // здесь также разумнее было бы кинуть исключение
            Route::ErrorPage404()
        }
    }

    
    function ErrorPage404()
    {
        $host = 'http://' . $_SERVER['HTTP_HOST'] . '/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:' . $host . '404');
    }
}


/*
 * Замечу, что в классе реализована очень упрощенная логика (несмотря на объемный код) и возможно даже имеет проблемы безопасности. Это было сделано намерено, т.к. написание полноценного класса маршрутизации заслуживает как минимум отдельной статьи. Рассмотрим основные моменты…
 *
 * В элементе глобального массива $_SERVER['REQUEST_URI'] содержится полный адрес по которому обратился пользователь.
 * Например: example.ru/contacts/feedback
 *
 * С помощью функции explode производится разделение адреса на составлющие. В результате мы получаем имя контроллера, для приведенного примера, это контроллер contacts и имя действия, в нашем случае — feedback.
 *
 * Далее подключается файл модели (модель может отсутствовать) и файл контроллера, если таковые имеются и наконец, создается экземпляр контроллера и вызывается действие, опять же, если оно было описано в классе контроллера.
 *
 * Таким образом, при переходе, к примеру, по адресу:
 * example.com/portfolio
 * или
 * example.com/portfolio/index
 * роутер выполнит следующие действия:
 *
 *  1) подключит файл model_portfolio.php из папки models, содержащий класс Model_Portfolio;
 *  2) подключит файл controller_portfolio.php из папки controllers, содержащий класс Controller_Portfolio;
 *  3) создаст экземпляр класса Controller_Portfolio и вызовет действие по умолчанию — action_index, описанное в нем.
 *
 *
 * Если пользователь попытается обратиться по адресу несуществующего контроллера, к примеру:
 * example.com/ufo
 * то его перебросит на страницу «404»:
 * example.com/404
 * То же самое произойдет если пользователь обратится к действию, которое не описано в контроллере.
 */