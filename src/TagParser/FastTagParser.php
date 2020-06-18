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

        $openTagLen  = strlen($this->openTag);
        $closeTagLen = strlen($this->closeTag);

        $openTagId  = 0;
        $closeTagId = 0;

        for ($index = 0; $index < $dataMaxLen; $index++, $openTagId = 0, $closeTagId = 0) {

            while (($index + $openTagId < $dataMaxLen) && ($openTagId < $openTagLen)
                && ($data[$index + $openTagId] === $this->openTag[$openTagId])) {
                $openTagId++;
            }
            if ($openTagId === $openTagLen) {
                $currentDeeptLvl++;
                if ($currentDeeptLvl === $deepLvl) {
                    $resultIndex++;
                    $result[] .= $this->openTag;
                    $index    += $openTagLen - 1;
                    continue;
                }
            }

            while (($index + $closeTagId < $dataMaxLen) && ($closeTagId < $closeTagLen)
                && ($data[$index + $closeTagId] === $this->closeTag[$closeTagId])) {
                $closeTagId++;
            }
            if ($closeTagId === $closeTagLen) {
                $currentDeeptLvl--;
                if ($currentDeeptLvl + 1 === $deepLvl) {
                    $result[$resultIndex] .= $this->closeTag;
                    $index                += $closeTagLen - 1;
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
