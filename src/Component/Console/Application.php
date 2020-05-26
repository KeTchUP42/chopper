<?php
declare(strict_types = 1);

namespace Chopper\Component\Console;

use Chopper\Component\Console\Command\CommandHandler;

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
        CommandHandler::main();
    }
}