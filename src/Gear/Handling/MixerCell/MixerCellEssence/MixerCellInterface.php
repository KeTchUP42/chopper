<?php
declare(strict_types = 1);

namespace Chopper\Gear\Handling\MixerCell\MixerCellEssence;

/**
 * @author Roman Bondarenko <rom_bon@mail.ru>
 *
 * MixerCellInterface
 */
interface MixerCellInterface
{
    /**
     * Handle method for templates combining
     *
     * @return string
     */
    public function handle(): string;
}
