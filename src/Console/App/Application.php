<?php
declare(strict_types = 1);

namespace App\Console\App;

use App\Console\Command\DownloadCommand;
use App\Console\Command\FilterCommand;
use App\Console\Command\MixerCommand;
use App\Logger\GlobalLogger\SystemLogger;
use Symfony\Component\Console\Application as App;

/**
 * @author Roman Bondarenko <rom_bon@mail.ru>
 *
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