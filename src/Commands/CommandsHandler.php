<?php
declare(strict_types = 1);

namespace Chopper\Commands;

use Chopper\Commands\CommandTraits\MainCommandTrait;
use Chopper\Tools\ColoredConsole\Console;
use Chopper\Traits\ClosedConstructorTrait;

/**
 * Easy console commands functional realization
 */
class CommandsHandler
{
    use MainCommandTrait;
    use ClosedConstructorTrait;

    /**
     * Commands start method
     */
    public static function main(): void
    {
        (new static)->handle($_SERVER['argv']);
    }

    /**
     * Method handles input args
     *
     * @param      $argv
     */
    private function handle(array $argv): void
    {
        try {
            $method = $argv[1] ?? 'error';
            $this->$method($argv[2] ?? null);
        } catch (\Error $error) {
            $this->error();
        }
    }

    /**
     * Standard console error handler
     */
    private function error(): void
    {
        Console::out()->color(Console::RED)->writeln("Err");
    }
}
