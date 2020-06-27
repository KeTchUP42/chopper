<?php
declare(strict_types = 1);

namespace Chopper\Console\App;

use Chopper\Console\Command\DownloadCommand;
use Chopper\Console\Command\FilterCommand;
use Chopper\Console\Command\MixerCommand;
use Chopper\Logger\GlobalLogger\SystemLogger;
use Symfony\Component\Console\Application as App;

/**
 * Application entry point.
 */
class Application
{
    /**
     * App starts
     */
    public function run(): void
    {
        $app = new App();
        $app->add(new DownloadCommand($_ENV['RESOURCE_DIR'], SystemLogger::getLoggerContainer()));
        $app->add(new FilterCommand($_ENV['RESOURCE_DIR'], $_ENV['TEMPLATES_DIR'], SystemLogger::getLoggerContainer()));
        $app->add(new MixerCommand($_ENV['TEMPLATES_DIR'], $_ENV['RESULT_DIR'], SystemLogger::getLoggerContainer()));
        $app->run();
    }
}