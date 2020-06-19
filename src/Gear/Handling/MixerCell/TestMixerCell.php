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
        if (count($this->files) > 0) {
            return $this->files[random_int(0, count($this->files) - 1)]->read();
        }

        throw new RuntimeException(sprintf("Files not found! %s", static::class));
    }
}