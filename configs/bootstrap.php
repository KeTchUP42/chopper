<?php
declare(strict_types = 1);

use Chopper\Logger\GlobalLogger\GLogger;

$_ENV['PROJECT_DIR'] = dirname(__DIR__.'/../', 2).'/';

$dotenv = Dotenv\Dotenv::createImmutable($_ENV['PROJECT_DIR']);
$dotenv->load();

$_ENV['LOG_FILE_PATH']  = $_ENV['PROJECT_DIR'].$_ENV['LOG_FILE_PATH'];
$_ENV['MAIN_RESOURCES'] = $_ENV['PROJECT_DIR'].$_ENV['MAIN_RESOURCES'].'/';
$_ENV['TEMPLATES']      = $_ENV['PROJECT_DIR'].$_ENV['TEMPLATES'].'/';
$_ENV['FINAL_DIR']      = $_ENV['PROJECT_DIR'].$_ENV['FINAL_DIR'].'/';

GLogger::configureGlobalLogger($_ENV['LOG_FILE_PATH']);

$_SERVER              = array_merge($_SERVER, $_ENV);
$_SERVER['APP_ENV']   = $_ENV['APP_ENV'] = ($_SERVER['APP_ENV'] ?? $_ENV['APP_ENV'] ?? null) ?: 'dev';
$_SERVER['APP_DEBUG'] = $_SERVER['APP_DEBUG'] ?? $_ENV['APP_DEBUG'] ?? 'prod' !== $_SERVER['APP_ENV'];
$_SERVER['APP_DEBUG'] = $_ENV['APP_DEBUG'] = (int) $_SERVER['APP_DEBUG'] || filter_var($_SERVER['APP_DEBUG'], FILTER_VALIDATE_BOOLEAN) ? '1' : '0';