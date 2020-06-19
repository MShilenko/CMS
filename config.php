<?php

// Defines

//DB
define('DB_HOST', 'localhost');
define('DB_LOGIN', 'felix');
define('DB_PASSWORD', '211187');
define('DB_NAME', 'cms');

// Dir
define('APP_DIR', __DIR__);
define('CONFIG_DIR', APP_DIR . '/configs');
define('VIEW_DIR', APP_DIR . '/view');
define('TEMPLATES_DIR', VIEW_DIR . '/layout');
define('THEMES_DIR', '/themes');
define('CORE_DIR', '/src/Core');
define('UPLOADS_DIR', THEMES_DIR . '/uploads');
define('FRONT_THEME_DIR', THEMES_DIR . '/clean-blog');
define('BACK_THEME_DIR', THEMES_DIR . '/sb-admin-2');

//View
define('VIEW_SEPARATOR', '.');

//Headers
define('NOT_FOUND', 404);
define('FORBIDDEN', 403);
define('INTERNAL_SERVER_ERROR', 500);

//Upload images
define("ALLOWED_IMAGE_TYPES", ['image/jpeg', 'image/png', 'image/svg']);
define("ALLOWED_IMAGE_SIZE", 2000000);

