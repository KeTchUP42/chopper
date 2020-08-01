<?php
declare(strict_types = 1);

namespace App\Gear\Handling\Mixer;

use App\Gear\Handling\MixerCell\MixerCellEssence\MixerCellInterface;

/**
 * @author Roman Bondarenko <rom_bon@mail.ru>
 *
 * MixerInterface
 */
interface MixerInterface
{
    /**
     * Установка MixerCell.
     *
     * @param MixerCellInterface $mixerCell
     *
     * @return MixerInterface
     */
    public function setMixerCell(MixerCellInterface $mixerCell): MixerInterface;

    /**
     * Method starts handling files
     *
     * @return string
     */
    public function handle(): ?string;
}
