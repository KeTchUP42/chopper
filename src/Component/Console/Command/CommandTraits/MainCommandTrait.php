<?php
declare(strict_types = 1);

namespace Chopper\Component\Console\Command\CommandTraits;

use Chopper\App\Mixer;

/**
 * MainCommandTrait
 */
trait MainCommandTrait
{
    /**
     * Method calls mixToFile method
     */
    private function mixtf(): void
    {
        (new Mixer())->mixToFile();
    }

    /**
     * Method calls console method
     *
     * @return string
     */
    private function mix(): string
    {
        return (new Mixer())->mix();
    }
}
