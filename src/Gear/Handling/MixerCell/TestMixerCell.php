<?php
declare(strict_types = 1);

namespace Chopper\Gear\Handling\MixerCell;

use Chopper\Exceptions\RuntimeException;
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
        if (count($this->fileContainers) > 0) {
            return $this->fileContainers[random_int(0, count($this->fileContainers))]->read();
        }

        throw new RuntimeException(sprintf("No files found! %s", static::class));
    }
}
