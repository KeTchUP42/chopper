<?php
declare(strict_types = 1);

namespace Chopper\Gear\Handling\MixerCell;

use Chopper\Gear\Handling\MixerCell\MixerCellEssence\AbstractMixerCell;
use RecursiveArrayIterator;
use RecursiveIteratorIterator;

/**
 * DirtMixerCell
 */
class DirtMixerCell extends AbstractMixerCell
{
    /**
     * Result wrapp
     */
    private const HTML_WRAPP_1 = "<!DOCTYPE html>\n<html lang=\"en\">\n<head>\n<meta charset=\"UTF-8\">\n<title>Test</title>\n</head>\n<body>\n";
    private const HTML_WRAPP_2 = "\n</body>\n</html>";

    /**
     * @inheritDoc
     */
    public function handle(): string
    {
        return $this->shuffle_merge();
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
            $fileData = unserialize($file->read(), [false]);
            if (is_array($fileData)) {
                $data[] = array_merge($data, $fileData);
            }
        }
        $data = iterator_to_array(new RecursiveIteratorIterator(new RecursiveArrayIterator($data)), false);
        shuffle($data);

        return self::HTML_WRAPP_1.implode('', $data).self::HTML_WRAPP_2;
    }
}
