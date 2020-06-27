<?php
declare(strict_types = 1);

namespace Chopper\Gear\Handling\MixerCell;

use Chopper\Exceptions\ErrorException;
use Chopper\Gear\Handling\MixerCell\MixerCellEssence\AbstractMixerCell;
use Chopper\Gear\Handling\Wrapper\BaseHtmlWrapper;
use RecursiveArrayIterator;
use RecursiveIteratorIterator;

/**
 * DirtMixerCell
 *
 * This mixer cell generates some dirt)
 */
class DirtMixerCell extends AbstractMixerCell
{
    /**
     * @var BaseHtmlWrapper
     */
    private $wrapper;

    /**
     * Конструктор.
     *
     * @param string $directory
     */
    public function __construct(string $directory)
    {
        parent::__construct($directory);
        $this->wrapper = new BaseHtmlWrapper();
    }

    /**
     * @inheritDoc
     */
    public function handle(): string
    {
        $this->configuringWarningHandler();
        $result = $this->shuffle_merge();
        $this->restoreHandler();

        return $result;
    }

    /**
     * Method configures error handler
     */
    private function configuringWarningHandler(): void
    {
        set_error_handler(static function ($severity, $message, $file, $line) {
            throw new  ErrorException($message, $severity, $severity, $file, $line);
        });
    }

    /**
     * Merging algorithm
     *
     * @return string
     */
    private function shuffle_merge(): string
    {
        $data = [];
        foreach ($this->files as $file) {
            try {
                $fileData = unserialize($file->read(), [false]);
            } catch (ErrorException $error) {
                continue;
            }
            if (is_array($fileData)) {
                $data[] = array_merge($data, $fileData);
            }
        }
        $data = iterator_to_array(new RecursiveIteratorIterator(new RecursiveArrayIterator($data)), false);
        shuffle($data);

        return $this->wrapper->wrap(implode('', $data));
    }

    /**
     * Method restores error handler
     */
    private function restoreHandler(): void
    {
        restore_error_handler();
    }
}
