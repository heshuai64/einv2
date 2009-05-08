<?php
	// This is the "Pro" version of configuration.inc.php, without any comments, and restructured in a way
	// that should make sense for most pro-users of Qcodo
	
	// As always, feel free to use, change or ignore.

	define('SERVER_INSTANCE', 'dev');

	switch (SERVER_INSTANCE) {
		case 'dev':
		case 'test':
		case 'stage':
		case 'prod':
			define ('__DOCROOT__', 'C:/xampp/htdocs');
			define ('__VIRTUAL_DIRECTORY__', '');
			define ('__SUBDIRECTORY__', '/tracmor');

			define('DB_CONNECTION_1', serialize(array(
				'adapter' => 'MySql',
				'server' => 'localhost',
				'port' => null,
				'database' => 'tracmor',
				'username' => 'root',
				'password' => '',
				'profiling' => false)));
			break;
	}

	define('ALLOW_REMOTE_ADMIN', false);
	define ('__URL_REWRITE__', 'none');

	define ('__DEVTOOLS_CLI__', __DOCROOT__ . __SUBDIRECTORY__ . '/_devtools_cli');
	define ('__INCLUDES__', __DOCROOT__ .  __SUBDIRECTORY__ . '/includes');
	define ('__QCODO__', __INCLUDES__ . '/qcodo');
	define ('__QCODO_CORE__', __INCLUDES__ . '/qcodo/_core');
	define ('__DATA_CLASSES__', __INCLUDES__ . '/data_classes');
	define ('__DATAGEN_CLASSES__', __INCLUDES__ . '/data_classes/generated');
	define ('__FORMBASE_CLASSES__', __INCLUDES__ . '/formbase_classes_generated');
	define ('__PANELBASE_CLASSES__', __INCLUDES__ . '/panelbase_classes_generated');
	define ('__DEVTOOLS__', __SUBDIRECTORY__ . '/_devtools');
	define ('__FORM_DRAFTS__', __SUBDIRECTORY__ . '/form_drafts');
	define ('__PANEL_DRAFTS__', __SUBDIRECTORY__ . '/panel_drafts');

	// We don't want "Examples", and we don't want to download them during qcodo_update
	define ('__EXAMPLES__', null);

	define ('__JS_ASSETS__', __SUBDIRECTORY__ . '/js');
	define ('__CSS_ASSETS__', __SUBDIRECTORY__ . '/css');
	define ('__IMAGE_ASSETS__', __SUBDIRECTORY__ . '/images');
	define ('__PHP_ASSETS__', __SUBDIRECTORY__ . '/includes/php');

	if ((function_exists('date_default_timezone_set')) && (!ini_get('date.timezone')))
		date_default_timezone_set('Asia/Shanghai');

	define('ERROR_PAGE_PATH', __PHP_ASSETS__ . '/_core/error_page.php');
?>
