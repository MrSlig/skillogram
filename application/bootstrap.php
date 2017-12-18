<?php

/* REQUIRED FIRST: */
require_once 'core/common/constants.php';	// connecting constants module;
// далее: предположительно можно что-то выгодать с путей-констант

/* CORE: */
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

/* ENGINE PARTS: */
require_once 'core/common/functions.php';	// connecting common functions class
require_once 'core/common/MIME.php'		// connecting <MIME types> module

// callBy/sort data from qsl db table
require_once 'core/common/callPosts.php';	// connecting post management class
require_once 'core/common/callUsers.php';	// connecting users management class (wip!)
require_once 'core/common/callTags.php';	// connecting tags management class (wip!)

require_once 'core/common/processPost.php'	// connecting single post creator class
require_once 'core/common/publish.php'	// connecting <publish new post> class (wip!)
require_once 'core/common/search.php'	// connecting search class

// keep in mind it's wip:
require_once 'core/common/authenticator.php'	// connecting user authenticator management class
require_once 'core/common/authorization.php'	// connecting user authorization management class

/* IGNITE: */
require_once 'core/common/db.php';	// connecting to sql database
$dbh = DB::connect();	// for all stmt (sql db requests)

require_once 'core/common/session.php'	// containing session class
Session::start();	// starting our session

require_once 'core/route.php';  // containing router class
Route::start();	// starting our router