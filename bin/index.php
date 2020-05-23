<?php
declare(strict_types = 1);

use Chopper\Commands\CommandsHandler;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../configs/config.php';

CommandsHandler::main();