<?php
declare(strict_types = 1);

namespace Chopper\Gear\Handling\MixerCell\MixerCellEssence;

/**
 * MixerCellInterface
 */
interface MixerCellInterface
{
    /**
     * MixerCell handle method for templates combining
     *
     * @return string
     */
    public function handle(): string;
}
