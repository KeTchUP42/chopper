<?php
declare(strict_types = 1);

namespace Chopper\Gear\Handling\Mixer;

use Chopper\Gear\Handling\MixerCell\MixerCellEssence\MixerCellInterface;

/**
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
