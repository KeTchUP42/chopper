<?php
declare(strict_types = 1);

namespace Chopper\Gear\Handling\MixerCell;

use Chopper\Gear\Handling\MixerCell\MixerCellEssence\AbstractMixerCell;

/**
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
