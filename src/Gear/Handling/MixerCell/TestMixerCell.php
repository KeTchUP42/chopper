<?php
declare(strict_types = 1);

namespace App\Gear\Handling\MixerCell;

use App\Gear\Handling\MixerCell\MixerCellEssence\AbstractMixerCell;

/**
 * @author Roman Bondarenko <rom_bon@mail.ru>
 *
 * TestMixerCell
 */
class TestMixerCell extends AbstractMixerCell
{
    /**
     * @inheritDoc
     */
    public function handle(): string
    {
        return $this->files[random_int(0, count($this->files) - 1)]->read();
    }
}
