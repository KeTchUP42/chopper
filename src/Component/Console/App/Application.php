<?php
declare(strict_types = 1);

namespace Chopper\Component\Console\App;

use Chopper\Component\Console\Command\ClearFileCommand;
use Chopper\Component\Console\Command\DownloadCommand;
use Symfony\Component\Console\Application as App;

/**
 * Application
 */
class Application
{
    /**
     * Console app starts
     */
    public function start(): void
    {
        $app = new App();
        $app->add(new DownloadCommand($_ENV['MAIN_RESOURCES']));
        $app->add(new ClearFileCommand($_ENV['MAIN_RESOURCES'], $_ENV['FINAL_DIR']));
        $app->run();
    }
}