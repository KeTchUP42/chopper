<?php
declare(strict_types = 1);

namespace Chopper\TagParser;

/**
 * BaseTagParser
 *
 * Slow but not case sensitive.
 */
class BaseTagParser extends AbstractTagParser
{
    /**
     * Method returns an array of strings between tags at the required level of nesting without case difference
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
                && (strcasecmp($data[$index + $openTagId], $this->openTag[$openTagId]) === 0)) {
                $openTagId++;
            }
            if ($openTagId === $openTagLen) {
                $currentDeeptLvl++;
                if ($currentDeeptLvl === $deepLvl) {
                    $resultIndex++;
                    $result[] .= substr($data, $index, $openTagLen);
                    $index    += $openTagLen - 1;
                    continue;
                }
            }

            while (($index + $closeTagId < $dataMaxLen) && ($closeTagId < $closeTagLen)
                && (strcasecmp($data[$index + $closeTagId], $this->closeTag[$closeTagId]) === 0)) {
                $closeTagId++;
            }
            if ($closeTagId === $closeTagLen) {
                $currentDeeptLvl--;
                if ($currentDeeptLvl + 1 === $deepLvl) {
                    $result[$resultIndex] .= substr($data, $index, $closeTagLen);
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
