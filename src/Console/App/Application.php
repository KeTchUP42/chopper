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
    public function run(): void
    {
        $app = new App();
        $app->add(new DownloadCommand($_ENV['RESOURCE_DIR']));
        $app->add(new FilterCommand($_ENV['RESOURCE_DIR'], $_ENV['TEMPLATES_DIR']));
        $app->run();
    }
}