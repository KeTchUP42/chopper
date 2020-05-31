<?php
declare(strict_types = 1);

namespace Chopper\Console\App;

use Chopper\Console\Command\DownloadCommand;
use Chopper\Console\Command\FilterCommand;
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
        $app->add(new FilterCommand($_ENV['MAIN_RESOURCES'], $_ENV['FINAL_DIR']));
        $app->run();
    }
}