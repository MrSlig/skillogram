<?php
/**
 *
 */

/* 1. --DIRECTORIES-- */
// needs workability cheking:
define('CORE_PATH',			__DIR__ . '/application/core/');
define('COMMON_PATH',		__DIR__ . '/application/core/common/');
define('CONTROLLERS_PATH',	__DIR__ . '/application/controllers/');
define('MODELS_PATH',		__DIR__ . '/application/models/');
define('VIEWS_PATH',		__DIR__ . '/application/view/');
define('IMAGES_PATH',		__DIR__ . '/assets/images/');
define('POSTS_PATH',		__DIR__ . '/assets/images/posts/');
define('AVATARS_PATH',		__DIR__ . '/assets/images/avatars/');
// case: DIR is site's root folder


/* 2. ---DATABASE---- */
// smbd on the internet said ' ' are critical in $dsn parametrs (you were warned)
define('SQL',		'mysql: ');	// type of sql db we connecting to
define('HOST',		'host=localhost; ');	// host, which we want to connect to
define('PORT',		'port=####; ');			// port, wich we want to connect to
define('DATABASE',	'dbname=skillogram');	// database name to connect to
define('USER',		'root');	// sql database username
define('PASSWORD',	'root');	// sql database password

define('CAN_REGISTER',	'any');
define('DEFAULT_ROLE',	'member');

define('SECURE',	FALSE);		// FOR DEVELOPMENT ONLY!


/* 3. -----DATE------ */
define('YEAR',		362 * 24 * 60 * 60);
define('MONTH',		30 * 24 * 60 * 60);
define('DAY',		24 * 60 * 60);
define('HOUR',		60 * 60);
define('MINUTE',	60);


/* 4. -----POST------ */
define('POSTS_ON_PAGE',		9);		// called in model_main
define('LOGIN_SIZE',		32);	// mirrors sql db user table value
define('SINGLE_TAG_SIZE',	32);	// mirrors sql db tags table value
define('TAGS_ON_POST',		16);
define('SUM_TAG_SIZE',		256);	// mirrors sql db posts table value
define('LEGEND_SIZE',		256);	// mirrors sql db posts table value


/* 5. -----USER------ */
define('MAX_USER_CALL',	16);	// called in model_main


/* 6. -----ELSE------ */
define('SALT',	'$up3r_$@17y');			// static salt for passwords encryption