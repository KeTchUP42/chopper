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
    protected $fileContainers;

    /**
     * Конструктор.
     *
     * @param string $templatesDirPath
     */
    public function __construct(string $templatesDirPath)
    {
        $this->fillFileContainers($templatesDirPath);
    }

    /**
     * Method fills file containers
     *
     * @param string $templatesDirPath
     */
    protected function fillFileContainers(string $templatesDirPath): void
    {
        $this->fileContainers = [];
        foreach (glob("$templatesDirPath*") as $filePath) {
            $this->fileContainers[] = new FileContainer($filePath);
        }
    }

    /**
     * MixerCell handle method for templates combining
     *
     * @return string
     */
    abstract public function handle(): string;
}
