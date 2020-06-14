<?php
declare(strict_types = 1);

namespace Chopper\Gear\Handling\MixerCell;

/**
 * MixerCellInterface
 */
interface MixerCellInterface
{
    /**
     * Mixer handle method to templates combining
     *
     * @param string $data
     *
     * @return string
     */
    public function handle(string $data): string;
}
