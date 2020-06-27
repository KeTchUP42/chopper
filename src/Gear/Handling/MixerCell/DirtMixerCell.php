<?php
declare(strict_types = 1);

namespace Chopper\Gear\Handling\MixerCell;

use Chopper\Exceptions\ErrorException;
use Chopper\Gear\Handling\MixerCell\MixerCellEssence\AbstractMixerCell;
use RecursiveArrayIterator;
use RecursiveIteratorIterator;

/**
 * DirtMixerCell
 * This mixer cell generates some dirt)
 */
class DirtMixerCell extends AbstractMixerCell
{
    /**
     * Result wrap
     */
    private const HTML_WRAP_1 = "<!DOCTYPE html>\n<html lang=\"en\">\n<head>\n<meta charset=\"UTF-8\">\n<title>Result</title>\n</head>\n<body>\n";
    private const HTML_WRAP_2 = "\n</body>\n</html>";

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

        return self::HTML_WRAP_1.implode('', $data).self::HTML_WRAP_2;
    }

    /**
     * Method configures error handler
     */
    private function configuringWarningHandler(): void
    {
        set_error_handler(static function ($severity, $message, $file, $line) {
            throw new  ErrorException($message, $severity, $severity, $file, $line);
        }
        );
    }

    /**
     * Method restores error handler
     */
    private function restoreHandler(): void
    {
        restore_error_handler();
    }
}
