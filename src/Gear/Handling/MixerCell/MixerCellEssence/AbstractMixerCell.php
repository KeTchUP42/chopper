<?php
declare(strict_types = 1);

namespace App\Gear\Handling\MixerCell\MixerCellEssence;

use App\Exceptions\RuntimeException;
use App\Gear\Handling\FileContainer\FileContainer;

/**
 * @author Roman Bondarenko <rom_bon@mail.ru>
 *
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
        $this->checkFilesAmount();
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
     * Method checks files amount
     */
    protected function checkFilesAmount(): void
    {
        if (count($this->files) === 0) {
            throw new RuntimeException(sprintf("Files not found! %s", static::class));
        }
    }

    /**
     * Handle method for templates combining
     *
     * @return string
     */
    abstract public function handle(): string;
}
