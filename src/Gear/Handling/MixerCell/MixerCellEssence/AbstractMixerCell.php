<?php
declare(strict_types = 1);

namespace Chopper\Gear\Handling\MixerCell\MixerCellEssence;

use Chopper\Gear\Handling\FileContainer\FileContainer;

/**
 * AbstractMixerCell
 */
abstract class AbstractMixerCell implements MixerCellInterface
{
    /**
     * @var array
     */
    protected $files;

    /**
     * Конструктор.
     *
     * @param string $directory
     */
    public function __construct(string $directory)
    {
        $this->fillFileContainers($directory);
    }

    /**
     * Method fills file containers
     *
     * @param string $directory
     */
    protected function fillFileContainers(string $directory): void
    {
        $this->files = [];
        foreach (glob("$directory/*") as $filePath) {
            $this->files[] = new FileContainer($filePath);
        }
    }

    /**
     * Handle method for templates combining
     *
     * @return string
     */
    abstract public function handle(): string;
}
