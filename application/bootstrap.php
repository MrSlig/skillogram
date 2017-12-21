<?php
/**
 * Загрузочный файл ядра сайта.
 *
 * Здесь обычно подключаются дополнительные модули, реализующие различный функционал:
 *  > аутентификацию
 *  > кеширование
 *  > работу с формами
 *  > абстракции для доступа к данным
 *  > ORM
 *  > Unit тестирование
 *  > Benchmarking
 *  > Работу с изображениями
 *  > Backup
 *  > и др.
 */
/* REQUIRED FIRST: */
require_once 'core/common/constants.php';	// connecting constants module;
// далее: предположительно можно что-то выгодать с путей-констант

/* CORE: */
require_once 'core/Model.php';      // base model
require_once 'core/View.php';       // base view
require_once 'core/Controller.php'; // base controller

/* ENGINE PARTS: */
require_once 'core/common/Functions.php';	// connecting common functions class
require_once 'core/common/MIME.php';        // connecting <MIME types> module

/* PLACEHOLDER (WIP): */
require_once 'core/common/CallPosts.php';	// connecting post management class
require_once 'core/common/CallUsers.php';	// connecting users management class (wip!)
require_once 'core/common/CallTags.php';	// connecting tags management class (wip!)

require_once 'core/common/ProcessPost.php';	// connecting single post creator class
require_once 'core/common/Publish.php';     // connecting <publish new post> class (wip!)
require_once 'core/common/Search.php';      // connecting search class

require_once 'core/common/Authenticator.php';	// connecting user authenticator management class
require_once 'core/common/Authorization.php';	// connecting user authorization management class

/* IGNITE: */
require_once 'core/common/DB.php';	// connecting to sql database
$dbh = DB::connect();               // for all stmt (sql db requests)
require_once 'core/Route.php';      // containing router class
Route::start();                     // starting our router

/*	OLD, UPDATE:
require_once 'core/common/session.php';	// containing session class
Session::start();                       // starting our session
*/
