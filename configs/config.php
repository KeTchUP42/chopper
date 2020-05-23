<?php
declare(strict_types = 1);

use Chopper\Tools\GLogger\GLogger;

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');

$_ENV['PROJECT_DIR'] = dirname(__DIR__ . '/../', 2) . '/';

$dotenv = Dotenv\Dotenv::createImmutable($_ENV['PROJECT_DIR']);
$dotenv->load();

$_ENV['LOG_FILE_PATH']  = $_ENV['PROJECT_DIR'] . $_ENV['LOG_FILE_PATH'];
$_ENV['HTML_RESOURCES'] = $_ENV['PROJECT_DIR'] . $_ENV['HTML_RESOURCES'];
$_ENV['TEMPLATES']      = $_ENV['PROJECT_DIR'] . $_ENV['TEMPLATES'];
$_ENV['FINAL_DIR']      = $_ENV['PROJECT_DIR'] . $_ENV['FINAL_DIR'];

GLogger::configureGlobalLogger($_ENV['LOG_FILE_PATH']);
