<?php

// отсебятина:
require_once 'core/common/constants.php';	// connecting constants module; далее: предположительно можно что-то выгодать с путей-констант

// подключаем файлы ядра:
require_once 'core/model.php';  // base model
require_once 'core/view.php';  // base view
require_once 'core/controller.php';  // base controller

/*
Здесь обычно подключаются дополнительные модули, реализующие различный функционал:
	> аутентификацию
	> кеширование
	> работу с формами
	> абстракции для доступа к данным
	> ORM
	> Unit тестирование
	> Benchmarking
	> Работу с изображениями
	> Backup
	> и др.
Например:
*/
require_once 'core/common/db.php';	// connecting to sql database
require_once 'core/common/functions.php';	// connecting functions module (is it a good case? idk)
require_once 'core/common/MIME.php'	// connecting <MIME types> module
require_once 'core/common/authentication.php'	// connecting authentication module
require_once 'core/common/registration.php'	// connecting registration module
require_once 'core/common/publish.php'	//  connecting <publish new post> module

require_once 'core/common/session.php'	// containing session class
Session::start();	// starting our session

require_once 'core/route.php';  // containing router class
Route::start();	// запускаем маршрутизатор