<?php
declare(strict_types = 1);

namespace Chopper\App;

use Chopper\Component\Console\ColoredConsole\Console;

/**
 * Main facade class
 */
class Mixer
{
    /**
     * Method creates new mixed html file and puts it to the FINAL_DIR
     */
    public function mixToFile(): void
    {
        Console::out()->color('red')->bgcolor('blue')->writeln("Done!");
    }

    /**
     * Method creates new mixed html string
     *
     * @return string
     */
    public function mix(): string
    {
        return '';
    }
}
