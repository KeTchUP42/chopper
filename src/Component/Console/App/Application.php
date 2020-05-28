<?php
declare(strict_types = 1);

namespace Chopper\Component\Console\App;

use Chopper\Component\Console\Command\DownloadCommand;
use Chopper\Component\Console\Command\FilterCommand;
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