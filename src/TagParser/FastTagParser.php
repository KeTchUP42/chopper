<?php
declare(strict_types = 1);

namespace Chopper\TagParser;

/**
 * FastTagParser
 *
 * This class has faster algorithm but tag case matters
 */
class FastTagParser extends AbstractTagParser
{
    /**
     * Method returns an array of strings between tags at the required level of nesting
     *
     * @param string $data
     * @param int    $deepLvl
     *
     * @return array
     */
    public function parseDeepLvl(string $data, int $deepLvl): array
    {
        if ($deepLvl <= 0) {
            return [$data];
        }

        if ($this->openTag === $this->closeTag) {
            return [];
        }

        $dataMaxLen      = strlen($data);
        $result          = [];
        $resultIndex     = -1;
        $currentDeeptLvl = 0;

        for ($index = 0; $index < $dataMaxLen; $index++) {

            if (substr($data, $index, strlen($this->openTag)) === $this->openTag) {
                $currentDeeptLvl++;
                if ($currentDeeptLvl === $deepLvl) {
                    $resultIndex++;
                    $result[] .= $this->openTag;
                    $index    += strlen($this->openTag) - 1;
                    continue;
                }
            }

            if (substr($data, $index, strlen($this->closeTag)) === $this->closeTag) {
                $currentDeeptLvl--;
                if ($currentDeeptLvl + 1 === $deepLvl) {
                    $result[$resultIndex] .= $this->closeTag;
                    $index                += strlen($this->closeTag) - 1;
                    continue;
                }
            }

            if ($currentDeeptLvl >= $deepLvl) {
                $result[$resultIndex] .= $data[$index];
            }
        }

        return $result;
    }
}
